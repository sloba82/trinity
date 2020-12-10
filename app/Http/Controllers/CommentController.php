<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\News;
use App\Models\Post;
use Illuminate\Http\Request;



class CommentController extends Controller
{

    public function index()
    {
        $comments = Comment::latest()->paginate(10);

        return view('comments.index', compact('comments'));
    }

    public function storePost(Request $request)
    {
        $input = $request->all();

        $post = Post::findOrFail($input['post_id']);
        $post->comments()->create([
            'comment' => $input['comment'],
            'name' => $input['name'],
            'email' => $input['email'],
            'type' => 'post',
        ]);

        return redirect()->route('post.show', ['id' => $input['post_id']])->with('success', 'New Comment is Created!');
    }

    public function storeNews(Request $request)
    {
        $input = $request->all();

        $post = News::findOrFail($input['news_id']);
        $post->comments()->create([
            'comment' => $input['comment'],
            'name' => $input['name'],
            'email' => $input['email'],
            'type' => 'news',
        ]);

        return redirect()->route('news.show', ['id' => $input['news_id']])->with('success', 'New Comment is Created!');
    }

    public function edit($id)
    {
        $comment = Comment::findOrFail($id);
        return view('comments.create', compact('comment'));
    }

    public function show($id)
    {
        $comment = Comment::findOrFail($id);
        return redirect()->route($comment->type . '.show', $comment->commentable_id . '#comment_' . $comment->id);
    }

    public function update(Request $request, $id = null)
    {
        $input = $request->all();
        $comment = Comment::findOrFail($id);
        $comment->update([
            'comment' => $input['comment']
        ]);

        return redirect()->route('comments.index')->with('success', 'Comment is updated!');
    }

    public function enable($id = null)
    {
        if ($this->status($id, 1)) {
            return redirect()->route('comments.index')->with('success', 'Comment is enabled!');
        }

        return redirect()->route('comments.index')->with('error', 'Something went wrong!');
    }

    public function disable($id = null)
    {

        if ($this->status($id, 0)) {
            return redirect()->route('comments.index')->with('success', 'Comment is disable!');
        }

        return redirect()->route('comments.index')->with('error', 'Something went wrong!');
    }

    private function status($id, $status)
    {
        $comment = Comment::findOrFail($id);
        return $comment->update([
            'status' => $status
        ]);
    }
}
