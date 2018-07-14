@extends('layouts.app') 
@section('content')
    @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
    @endif
<div class="panel panel-default">
    <div class="panel-heading">
        <img src="{{ $discuss->user->avatar }}" alt="" width="40px" height="40px">
        <span>{{ $discuss->user->name }}, <b>{{ $discuss->created_at->diffForHumans() }}</b></span>
        @if ($discuss->hasBestAnswer())
            <span class="btn btn-sm btn-default pull-right">Closed</span>
            @else
            <span class="btn btn-sm btn-success pull-right">Open</span>
        @endif
        @if ($discuss->isWatchedByAuth())
            <a href="{{ route('discussion.unwatch', $discuss->id) }}" class="btn btn-sm btn-default pull-right">Unwatch</a>
        @else
            <a href="{{ route('discussion.watch', $discuss->id) }}" class="btn btn-sm btn-default pull-right">Watch</a>
        @endif
    </div>

    <div class="panel-body">
        <h4 class="text-center">
            <b>{{ $discuss->title }}</b>
        </h4>
        <hr>
        <div class="text-center">
            {{ $discuss->content }}
        </div>
        <hr>
        @if ($bestAnswer)
            <div class="text-center">
                <h4 class="text-center">Best Answer</h4> 
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <img src="{{ $bestAnswer->user->avatar }}" alt="" width="40px" height="40px">
                        <span>{{ $bestAnswer->user->name }}</span>                        
                    </div>
                    <div class="panel-body">
                        {{ $bestAnswer->content }}
                    </div>
                </div>
            </div>
        @endif
    </div>

    <div class="panel-footer">
        @if (Auth::id() == $discuss->user->id)
            <form action="{{ route('discussion.destroy', $discuss->id) }}" method="POST">
                {{ method_field('DELETE') }}{{ csrf_field() }}
                <button type="submit" class="btn btn-sm btn-danger pull-right" onclick="confirm('Are you sure want to delete this discussion ?')">Delete</button>
                <a href="{{ route('discussion.edit', $discuss->id) }}" class="btn btn-sm btn-primary pull-right">Edit</a>
            </form>
        @endif
        <p>{{ $discuss->replies->count() }} Replies</p>
    </div>
</div>

@foreach ($discuss->replies as $reply)
    <div class="panel panel-default">
        <div class="panel-heading">
            <img src="{{ $reply->user->avatar }}" alt="" width="40px" height="40px">
            <span>{{ $reply->user->name }}, <b>{{ $discuss->created_at->diffForHumans() }}</b></span>
            
            @if (Auth::id() == $discuss->user->id)
                @if (!$bestAnswer)
                    <a href="{{ route('reply.answered', $reply->id) }}" class="btn btn-xs btn-info pull-right">Mark as best answer</a>
                @endif
                @if ($reply->is_answered)
                    <a href="{{ route('reply.answered.remove', $reply->id) }}" class="btn btn-xs btn-danger pull-right">Remove as best answer</a>
                @endif
            @endif
        </div>
    
        <div class="panel-body">
            <div class="text-center">
                {{ $reply->content }}
            </div>
        </div>
    
        <div class="panel-footer">
            @if (Auth::id() == $reply->user_id)
                <form action="{{ route('reply.destroy', $reply->id) }}" method="POST">
                    {{ method_field('DELETE') }}{{ csrf_field() }}
                    <button class="btn btn-xs btn-danger pull-right" type="submit" onclick="confirm('Are you sure want to delete this reply ?')">Delete</button>
                    <a href="{{ route('reply.edit', $reply->id) }}" class="btn btn-xs btn-primary pull-right">Edit</a>
                </form>
            @endif
            @if ($reply->isLikedByAuth())
                <a href="{{ route('reply.unlike', $reply->id) }}" class="btn btn-xs btn-danger">Unlike <span class="badge">{{ $reply->likes->count() }}</span></a>
            @else
                <a href="{{ route('reply.like', $reply->id) }}" class="btn btn-xs btn-success">Like <span class="badge">{{ $reply->likes->count() }}</span></a>
            @endif
        </div>
    </div>
@endforeach

<div class="panel panel-default">
    <div class="panel-body">
        @if (Auth::check())
            @if ($errors->count() > 0)
                <ul>
                    @foreach ($errors->all() as $error)
                        <li class="text-danger">
                            {{ $error }}
                        </li>
                    @endforeach
                </ul>
            @endif
            <form action="{{ route('discussion.reply', $discuss->id) }}" method="POST">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="reply">Leave a reply ...</label>
                    <textarea name="content" id="content" cols="30" rows="10" class="form-control">{{ old('content') }}</textarea>
                </div>
                <div class="form-group">
                    <button class="btn btn-success pull-right">Leave a reply</button>
                </div>
            </form>
        @else
            <div class="text-center">
                <h2>Sign in to leave a reply.</h2>
            </div>
        @endif
    </div>
</div>
@endsection