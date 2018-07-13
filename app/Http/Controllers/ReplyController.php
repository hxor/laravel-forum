<?php

namespace App\Http\Controllers;

use App\Like;
use Illuminate\Http\Request;
use Session;

class ReplyController extends Controller
{
    public function like(Request $request, $id)
    {
        Like::create([
            'user_id' => $request->user()->id,
            'reply_id' => $id
        ]);

        Session::flash('status', 'You liked the reply.');

        return redirect()->back();
    }

    public function unlike(Request $request, $id)
    {
        Like::where('user_id', $request->user()->id)->where('reply_id', $id)->delete();

        Session::flash('status', 'You unliked the reply.');

        return redirect()->back();
    }
}
