<?php

namespace App\Http\Controllers;

use App\Like;
use App\Reply;
use Illuminate\Http\Request;

class ReplyController extends Controller
{
    public function edit($id)
    {
        $reply = Reply::findOrFail($id);
        return view('pages.reply.edit', compact('reply'));
    }

    public function update(Request $request, $id)
    {
        $reply = Reply::findOrFail($id);

        $this->validate($request, [
            'content' => 'required|min:10'
        ]);

        $reply->update([
            'content' => $request->content
        ]);

        request()->session()->flash('success', 'Answer successfully updated.');

        return redirect()->route('discussion.show', $reply->discussion->slug);
    }

    public function destroy($id)
    {
        $reply = Reply::findOrFail($id);
        $reply->delete();

        request()->session()->flash('success', 'Answer successfully deleted.');

        return redirect()->route('discussion.show', $reply->discussion->slug);
    }

    public function like(Request $request, $id)
    {
        Like::create([
            'user_id' => $request->user()->id,
            'reply_id' => $id
        ]);

        $request->session()->flash('success', 'You liked the reply.');

        return redirect()->back();
    }

    public function unlike(Request $request, $id)
    {
        Like::where('user_id', $request->user()->id)->where('reply_id', $id)->delete();

        $request->session()->flash('success', 'You unliked the reply.');

        return redirect()->back();
    }

    public function bestAnswer($id)
    {
        $reply = Reply::find($id);
        $reply->update([
            'is_answered' => 1
        ]);

        request()->session()->flash('success', 'Reply has been marked as the best answer.');

        return redirect()->back();
    }

    public function removeBestAnswer($id)
    {
        $reply = Reply::find($id);
        $reply->update([
            'is_answered' => 0
        ]);
        request()->session()->flash('success', 'Reply has been removed as the best answer.');

        return redirect()->back();
    }
}
