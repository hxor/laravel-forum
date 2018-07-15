@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">Profile: <b>{{ $user->name }}</b></div>

        <div class="panel-body">
            <table class="table">
                <tbody>
                    <tr>
                        <th>Name</th>
                        <td>{{ $user->name }}</td>
                    </tr>
                    <tr>
                        <th>Birth Date</th>
                        <td>{{ $user->birth }}</td>
                    </tr>
                    <tr>
                        <th>Gender</th>
                        <td>{{ ucwords($user->gender) }}</td>
                    </tr>
                    <tr>
                        <th>Address</th>
                        <td>{{ $user->address }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{ $user->email }}</td>
                    </tr>
                    <tr>
                        <th>Avatar</th>
                        <td>
                            <img src="{{ substr($user->avatar, 0, 4) == 'http' ? $user->avatar : asset($user->avatar) }}" alt="" width="60px" height="60px">
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
