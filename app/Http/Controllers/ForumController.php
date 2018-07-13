<?php

namespace App\Http\Controllers;

use App\Discussion;
use App\Channel;
use Illuminate\Http\Request;

class ForumController extends Controller
{
    public function index()
    {
        $discuss = Discussion::orderBy('created_at', 'desc')->paginate(3);
        return view('pages.forum.index', compact('discuss'));
    }

    public function channel($slug)
    {
        $channel = Channel::where('slug', $slug)->first();
        $discussions = $channel->discussions()->paginate(5);
        return view('pages.forum.channel', compact('discussions'));
    }
}
