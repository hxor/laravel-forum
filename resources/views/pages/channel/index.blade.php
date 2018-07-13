@extends('layouts.app') 
@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">Channels</div>

        <div class="panel-body">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <table class="table table-hover">
                <thead>
                    <th>Name</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </thead>
                <tbody>
                    @foreach ($channels as $channel)
                        <tr>
                            <td>{{ $channel->title }}</td>
                            <td><a href="{{ route('admin.channel.edit', $channel->id) }}" class="btn btn-xs btn-info">Edit</a></td>
                            <td>
                                <form action="{{ route('admin.channel.destroy', $channel->id) }}" method="POST">
                                    {{ method_field('DELETE') }} {{ csrf_field() }}
                                    <button class="btn btn-xs btn-danger" type="submit">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection