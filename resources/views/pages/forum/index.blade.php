@extends('layouts.app') 
@section('content')
 @foreach ($discuss as $row)
     <div class="panel panel-default">
        <div class="panel-heading">
            <img src="{{ substr($row->user->avatar, 0, 4) == 'http' ? $row->user->avatar : asset($row->user->avatar) }}" alt="" width="40px" height="40px">
            <span><b><a href="{{ route('profile.show', $row->user->id) }}">{{ $row->user->name }}</a>, {{ $row->created_at->diffForHumans() }}</b>
            
            <a href="{{ route('discussion.show', $row->slug) }}" class="btn btn-sm btn-default pull-right">View</a>
        </div>
    
        <div class="panel-body">
            <h4 class="text-center">
                <b>{{ $row->title }}</b>
            </h4>
            <div class="text-center">
                {{ str_limit($row->content, 100) }}
            </div>
        </div>

        <div class="panel-footer">
            <span>{{ $row->replies->count() }} Replies</span>
            <a href="{{ route('forum.channel', $row->channel->slug) }}" class="btn btn-xs btn-default pull-right">{{ $row->channel->title }}</a>
        </div>
    </div>
 @endforeach
 <div class="text-center">
     {{ $discuss->links() }}
 </div>
@endsection