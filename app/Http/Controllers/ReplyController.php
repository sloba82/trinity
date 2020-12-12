<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateReplyRequest;
use App\Models\Reply;
use App\Services\Mail\SendMail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
        DB::beginTransaction();
        try {
            $reply = Reply::findOrFail($id);
            $reply->update(['status' => 1]);

            SendMail::send($reply->comment->email, 'ApprovedReply',  [
                'comment' => $reply->reply,
            ]);
            DB::commit();
            return redirect()->back()->with('success', 'Reply is enabled!');
        } catch (\Exception $exception) {
            Log::error('Error while updating replay status ' . $exception);
            DB::rollBack();
            return false;
        }
    }
}
