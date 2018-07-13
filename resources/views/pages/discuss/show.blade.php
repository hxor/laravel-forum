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
    </div>

    <div class="panel-body">
        <h4 class="text-center">
            <b>{{ $discuss->title }}</b>
        </h4>
        <hr>
        <div class="text-center">
            {{ $discuss->content }}
        </div>
    </div>

    <div class="panel-footer">
        <p>{{ $discuss->replies->count() }} Replies</p>
    </div>
</div>

@foreach ($discuss->replies as $reply)
    <div class="panel panel-default">
        <div class="panel-heading">
            <img src="{{ $reply->user->avatar }}" alt="" width="40px" height="40px">
            <span>{{ $reply->user->name }}, <b>{{ $discuss->created_at->diffForHumans() }}</b></span>
        </div>
    
        <div class="panel-body">
            <div class="text-center">
                {{ $reply->content }}
            </div>
        </div>
    
        <div class="panel-footer">
            Like
        </div>
    </div>
@endforeach

<div class="panel panel-default">
    <div class="panel-body">
        <form action="{{ route('discussion.reply', $discuss->id) }}" method="POST">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="reply">Leave a reply ...</label>
                <textarea name="content" id="content" cols="30" rows="10" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <button class="btn btn-succss pull-right">Reply</button>
            </div>
        </form>
    </div>
</div>
@endsection