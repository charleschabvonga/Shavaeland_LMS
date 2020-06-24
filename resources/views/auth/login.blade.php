@extends('layouts.auth')

@section('content')
<head>
    <style>
        body {
            background-image: url(/images/road.jpg);
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }
        .row {
            width: 60%;
            opacity: 0.65; /* .foo will be 50% transparent */
        }
        label {
            color: #000;
        }
    </style>
</head>
<body>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">@lang('global.app_login')</div>
                <div class="panel-body">
                    @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> @lang('global.app_there_were_problems_with_input'):
                        <br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <form class="form-horizontal"
                        role="form"
                        method="POST"
                        action="{{ url('login') }}">
                        <input type="hidden"
                            name="_token"
                            value="{{ csrf_token() }}">

                        <div class="form-group">
                            <label class="col-md-4 control-label">@lang('global.app_email')</label>

                            <div class="col-md-6">
                                <input type="email"
                                    class="form-control"
                                    name="email"
                                    value="{{ old('email') }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">@lang('global.app_password')</label>

                            <div class="col-md-6">
                                <input type="password"
                                    class="form-control"
                                    name="password">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <a href="{{ route('auth.password.reset') }}">@lang('global.app_forgot_password')</a>
                                <br>
                                <a href="{{ route('auth.register') }}">@lang('global.app_registration')</a>
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <label>
                                    <input type="checkbox"
                                        name="remember"> @lang('global.app_remember_me')
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit"
                                        class="btn btn-primary"
                                        style="margin-right: 15px;">
                                    @lang('global.app_login')
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

@endsection