@extends('layouts.app') 
@section('content')
<div class="panel panel-default">
    <div class="panel-heading">Channel</div>

    <div class="panel-body">
        <form action="{{ route('admin.channel.store') }}" method="POST" class="">
            {{ csrf_field() }}

            <div class="form-group">
                <input type="text" class="form-control" name="title">
            </div>

            <div class="form-group">
                <div class="text-center">
                    <button class="btn btn-success" type="submit">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection