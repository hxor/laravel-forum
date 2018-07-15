<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('vendor/toastr/jquery.toast.min.css') }}">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @guest
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ route('profile.index') }}">Profile</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container">
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <a href="{{ route('discussion.create') }}" class="form-control btn btn-primary">Create a new discussion</a>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-body">
                        <ul class="list-group">
                            <li class="list-group-item">
                                <a href="{{ route('forum.index') }}">Home</a>
                            </li>
                            <li class="list-group-item">
                                <a href="{{ url('/forum?filter=me') }}">My Discussion</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <hr>
                @if (Auth::check())
                    @if (Auth::user()->admin)
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <a href="{{ route('admin.channel.index') }}" class="form-control btn btn-primary">Create a new channel</a>
                            </div>
                        </div>
                    @endif
                @endif
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Channels
                    </div>
                    <div class="panel-body">
                        <ul class="list-group">
                            @foreach ($channels as $channel)
                                <li class="list-group-item">
                                    <a href="{{ route('forum.channel', $channel->slug) }}">{{ $channel->title }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                @yield('content')
            </div>
        </div>

    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('vendor/toastr/jquery.toast.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script>
        $(function() {
            @if(Session::has('success'))
                $.toast({
                    heading: 'Success!',
                    text: '{{ Session::get("success") }}',
                    position: 'top-right',
                    loaderBg:'#ff6849',
                    icon: 'success',
                    hideAfter: 3500, 
                    stack: 6
                });
            @endif
            $('.date-picker').datepicker({
                format: "yyyy-mm-dd",
                autoclose: true,
                todayHighlight: true
            });
        });
    </script>
</body>
</html>
