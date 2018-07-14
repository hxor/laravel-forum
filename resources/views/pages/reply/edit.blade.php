@extends('layouts.app') 
@section('content')
<div class="panel panel-default">
    <div class="panel-heading text-center">
        Update a reply
    </div>

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
        
        <form action="{{ route('reply.update', $reply->id) }}" method="POST">
            {{ method_field('PUT') }} {{ csrf_field() }}
            <div class="form-group">
                <label for="content">Answer a question</label>
                <textarea name="content" id="content" cols="30" rows="10" class="form-control">{{ $reply->content }}</textarea>
            </div>
            <div class="form-group">
                <button class="btn btn-success pull-right">Save</button>
            </div>
        </form>
    </div>
</div>
@endsection