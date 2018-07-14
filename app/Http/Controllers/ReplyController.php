<?php

namespace App\Http\Controllers;

use App\Like;
use App\Reply;
use Illuminate\Http\Request;

class ReplyController extends Controller
{
    public function like(Request $request, $id)
    {
        Like::create([
            'user_id' => $request->user()->id,
            'reply_id' => $id
        ]);

        $request->session()->flash('status', 'You liked the reply.');

        return redirect()->back();
    }

    public function unlike(Request $request, $id)
    {
        Like::where('user_id', $request->user()->id)->where('reply_id', $id)->delete();

        $request->session()->flash('status', 'You unliked the reply.');

        return redirect()->back();
    }

    public function bestAnswer($id)
    {
        $reply = Reply::find($id);
        $reply->update([
            'is_answered' => 1
        ]);

        request()->session()->flash('status', 'Reply has been marked as the best answer.');

        return redirect()->back();
    }
}
