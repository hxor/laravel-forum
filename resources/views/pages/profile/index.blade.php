@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">Register</div>

        <div class="panel-body">
            <form class="form-horizontal" method="POST" action="{{ route('profile.store') }}" enctype="multipart/form-data">
                {{ csrf_field() }}

                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label for="name" class="col-md-4 control-label">Name</label>

                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control" name="name" value="{{ old('name', $user->name) }}" required autofocus>

                        @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('birth') ? ' has-error' : '' }}">
                    <label for="birth" class="col-md-4 control-label">Birth Date</label>
                    <div class="col-md-6">
                        <div class="input-group date">
                            <input type="text" name="birth" id="birth" class="form-control date-picker" value="{{ old('birth', $user->birth) }}" required>
                            <div class="input-group-addon">
                                <span class="glyphicon glyphicon-th"></span>
                            </div>
                        </div>
                        
                        @if ($errors->has('birth'))
                            <span class="help-block">
                                <strong>{{ $errors->first('birth') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                

                <div class="form-group{{ $errors->has('gender') ? ' has-error' : '' }}">
                    <label for="gender" class="col-md-4 control-label">Gender</label>
                    <div class="col-md-6">

                        <label class="radio-inline">
                            <input type="radio" name="gender" id="gender-male" value="male" {{ $user->gender == 'male' ? 'checked' : ''}}>Male
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="gender" id="gender-female" value="female" {{ $user->gender == 'female' ? 'checked' : ''}}>Female
                        </label>
                        
                        @if ($errors->has('gender'))
                            <span class="help-block">
                                <strong>{{ $errors->first('gender') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                    <label for="birth" class="col-md-4 control-label">Address</label>
                    <div class="col-md-6">
                        <textarea name="address" id="address" cols="30" rows="5" class="form-control">{{ old('address', $user->address) }}</textarea>
                        
                        @if ($errors->has('address'))
                            <span class="help-block">
                                <strong>{{ $errors->first('address') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('photo') ? ' has-error' : '' }}">
                    <label for="photo" class="col-md-4 control-label">photo</label>
                    <div class="col-md-4">
                        <input type="file" placeholder='Choose a file...' name="photo" value="{{ old('photo', $user->avatar) }}"/>
                        
                        @if ($errors->has('photo'))
                            <span class="help-block">
                                <strong>{{ $errors->first('photo') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="col-md-4">
                        @if(!empty($user->avatar))
                            <img src="{{ asset($user->avatar) }}" alt="logo" height="150" width="150">
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email', $user->email) }}" required>

                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="password" class="col-md-4 control-label">Password</label>

                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control" name="password">

                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                    <div class="col-md-6">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <button type="submit" class="btn btn-primary">
                            Register
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
