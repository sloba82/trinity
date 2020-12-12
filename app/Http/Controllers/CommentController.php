<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCommentRequest;
use App\Models\Comment;
use App\Models\News;
use App\Models\Post;
use App\Services\Mail\SendMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CommentController extends Controller
{
    private $commentObject;

    /**
     * Return all comments
     */
    public function index()
    {
        $comments = Comment::latest()->paginate(10);
        return view('comments.index', compact('comments'));
    }

    /**
     * Store comments for posts
     * @param array $request
     *
     */
    public function storePost(CreateCommentRequest $request)
    {
        $input = $request->validated();
        $input['type'] = 'post';

        $this->commentObject = Post::findOrFail($input['post_id']);
        if ($this->createComment($input)) {
            return redirect()->route('post.show', ['id' => $input['post_id']])->with('success', 'New Comment is Created!');
        }

        return redirect()->route('post.show', ['id' => $input['post_id']])->with('error', 'Something went wrong!');
    }

    /**
     * Store comments for news
     * @param array $request
     *
     */
    public function storeNews(CreateCommentRequest $request)
    {
        $input = $request->validated();
        $input['type'] = 'news';

        $this->commentObject = News::findOrFail($input['news_id']);
        if ($this->createComment($input)) {
            return redirect()->route('news.show', ['id' => $input['news_id']])->with('success', 'New Comment is Created!');
        }

        return redirect()->route('news.show', ['id' => $input['news_id']])->with('error', 'Something went wrong!');
    }

    /**
     * Return comment by id
     * @param int $id
     *
     */
    public function edit($id)
    {
        $comment = Comment::findOrFail($id);
        return view('comments.create', compact('comment'));
    }

    /**
     * Show single comment
     * @param int $id
     *
     */
    public function show($id)
    {
        $comment = Comment::findOrFail($id);
        return redirect()->route($comment->type . '.show', $comment->commentable_id . '#comment_' . $comment->id);
    }

    /**
     * Update comment by id
     * @param array $request
     * @param int $id
     *
     */
    public function update(Request $request, $id = null)
    {
        $input = $request->all();
        $comment = Comment::findOrFail($id);
        $comment->update([
            'comment' => $input['comment']
        ]);

        return redirect()->route('comments.index')->with('success', 'Comment is updated!');
    }

    /**
     * Set comment status to active
     * @param int $id
     */
    public function enable($id = null)
    {
        if ($this->status($id, 1)) {
            return redirect()->route('comments.index')->with('success', 'Comment is enabled!');
        }

        return redirect()->route('comments.index')->with('error', 'Something went wrong!');
    }

    /**
     * Set comment status to inactive
     * @param int
     *
     */
    public function disable($id = null)
    {

        if ($this->status($id, 0)) {
            return redirect()->route('comments.index')->with('success', 'Comment is disable!');
        }

        return redirect()->route('comments.index')->with('error', 'Something went wrong!');
    }

    /**
     * Update status and send email
     * @param int $id
     * @param int $status
     */
    private function status($id, $status)
    {
        DB::beginTransaction();
        try {

            $comment = Comment::findOrFail($id);
            if ($status == 1) {
                SendMail::send($comment->email, 'ApprovedComment',  [
                    'comment' => 'Your comment is approved',
                ]);
            }
            $comment->update([
                'status' => $status
            ]);
            DB::commit();
            return true;
        } catch (\Exception $exception) {
            Log::error('Error while updating comment status ' . $exception);
            DB::rollBack();
            return false;
        }
    }

    /**
     * Create comment for post or news
     * @param array
     *
     */
    private function createComment($input)
    {
        DB::beginTransaction();
        try {
            $comment = $this->commentObject;
            $comment->comments()->create($input);

            SendMail::send($comment->author->email, 'NewComment',  [
                'name' => $comment->author->name,
                'comment' => $input['comment'],
            ]);
            DB::commit();
            return true;
        } catch (\Exception $exception) {
            Log::error('Error while creating comment ' . $exception);
            DB::rollBack();
            return false;
        }
    }
}
