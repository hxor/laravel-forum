@extends('layouts.app') 
@section('content') 
    @foreach ($discussions as $row)
    <div class="panel panel-default">
        <div class="panel-heading">
            <img src="{{ $row->user->avatar }}" alt="" width="40px" height="40px">
            <span>{{ $row->user->name }}, <b>{{ $row->created_at->diffForHumans() }}</b></span>
            @if ($row->hasBestAnswer())
                <span class="btn btn-sm btn-success pull-right">Closed</span>
                @else
                <span class="btn btn-sm btn-danger pull-right">Open</span>
            @endif
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
            <p>{{ $row->replies->count() }} Replies</p>
        </div>
    </div>
    @endforeach
    <div class="text-center">
        {{ $discussions->links() }}
    </div>
@endsection