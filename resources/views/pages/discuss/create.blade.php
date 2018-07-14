@extends('layouts.app') 
@section('content')
<div class="panel panel-default">
    <div class="panel-heading">Create a new discussion</div>

    <div class="panel-body">
        @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
        @endif

        @if ($errors->count() > 0)
            <ul>
                @foreach ($errors->all() as $error)
                    <li class="text-danger">
                        {{ $error }}
                    </li>
                @endforeach
            </ul>
        @endif
        
        <form action="{{ route('discussion.store') }}" method="POST">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="channel_id">Pick a channel</label>
                <select name="channel_id" id="channel_id" class="form-control">
                    @foreach ($channels as $channel)
                        <option value="{{ $channel->id }}">{{ $channel->title }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" name="title" value="{{ old('title') }}">
            </div>
            <div class="form-group">
                <label for="content">Ask a question</label>
                <textarea name="content" id="content" cols="30" rows="10" class="form-control">{{ old('content') }}</textarea>
            </div>
            <div class="form-group">
                <button class="btn btn-success pull-right">Create discussion</button>
            </div>
        </form>
    </div>
</div>
@endsection