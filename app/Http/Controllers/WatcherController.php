<?php

namespace App\Http\Controllers;

use App\Watcher;
use Illuminate\Http\Request;

class WatcherController extends Controller
{
    public function watch($id)
    {
        Watcher::create([
            'user_id' => request()->user()->id,
            'discussion_id' => $id
        ]);

        \Session::flash('status', 'You are watching this discussion.');

        return redirect()->back();
    }

    public function unwatch($id)
    {
        Watcher::where('user_id', request()->user()->id)->where('discussion_id', $id)->delete();

        \Session::flash('status', 'You are no longer watching this discussion.');

        return redirect()->back();
    }
}
