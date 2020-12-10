<?php

namespace App\Http\Controllers;

use App\Models\Reply;
use Illuminate\Http\Request;

class ReplyController extends Controller
{

    public function store(Request $request, $id = null)
    {
        $input = $request->all();
        $name = 'reply_' . $id;
        Reply::create([
            'comment_id' => $id,
            'reply' => $input[$name]
        ]);

        return redirect()->back();
    }

    public function destroy($id)
    {
        Reply::destroy($id);
        return redirect()->back()->with('success', 'Reply is deleted!');
    }
}
