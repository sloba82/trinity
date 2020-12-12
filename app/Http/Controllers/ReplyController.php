<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateReplyRequest;
use App\Models\Reply;
use App\Services\Mail\SendMail;

class ReplyController extends Controller
{

    /**
     * Create reply for comment
     * @param array $request
     * @param int $id
     */
    public function store(CreateReplyRequest $request, $id = null)
    {

        $input = $request->all();
        $name = 'reply_' . $id;
        Reply::create([
            'comment_id' => $id,
            'reply' => $input[$name]
        ]);

        return redirect()->back();
    }

    /**
     * Delete reply
     * @param int $id
     */
    public function destroy($id)
    {
        Reply::destroy($id);
        return redirect()->back()->with('success', 'Reply is deleted!');
    }

    /**
     * Set reply to active and send email
     *
     */
    public function enable($id)
    {
        $reply = Reply::findOrFail($id);

        SendMail::send($reply->comment->email, 'ApprovedReply',  [
            'comment' => $reply->reply,
        ]);

        $reply->update(['status' => 1]);
        return redirect()->back()->with('success', 'Reply is enabled!');
    }
}
