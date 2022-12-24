@extends('backend.layouts.layout')

@section('content')
@php
if(!empty($_GET['event'])){
$event_id=$_GET['event'];
Session::put('event_id', $event_id);
}
@endphp
<div class="h-100 bg-cover bg-center py-5 d-flex align-items-center" style="background-image: url({{ uploaded_asset(get_setting('admin_login_background')) }})">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-xl-5 mx-auto">
                <div class="card text-left cst-box-shadow">
                    <div class="card-body">
                        <div class="mb-5 text-center">
                            @if(get_setting('system_logo_black') != null)
                                <img src="{{ uploaded_asset(get_setting('system_logo_black')) }}" class="mw-100 mb-4 login-logo" height="40">
                            @else
                                <img src="{{ static_asset('assets/img/logo.png') }}" class="mw-100 mb-4" height="40">
                            @endif
                            <h3 class="fs-22 cst-text-primary mb-0">{{ translate('Welcome to') }} {{ env('APP_NAME') }}</h3>
                            <!--<p>{{ translate('Login to your account.') }}</p>-->
                        </div>
                        <form class="pad-hor" method="POST" role="form" action="{{ route('login') }}">
                            @csrf
                            <div class="form-group row">
                                <div class="col-12">
                                <label class="cst-text-primary fs-14 text-left">Email address</label>
                                </div>
                                <div class="col-12">
                                <input type="hidden" name="event_id" value="@if(!empty($event_id)){{$event_id}}@endif">   
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }} cst-input-outline-primary" name="email" value="{{ old('email') }}" required autofocus>
                                </div>
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group row">
                                <div class="col-12">
                                <label class="cst-text-primary fs-14 text-left">Password</label>
                                </div>
                                <div class="col-12">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }} cst-input-outline-primary" name="password" required>
                                </div>
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="row mb-2">
                                <!--<div class="col-sm-6">-->
                                <!--    <div class="text-left">-->
                                <!--        <label class="aiz-checkbox">-->
                                <!--            <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>-->
                                <!--            <span>{{ translate('Remember Me') }}</span>-->
                                <!--            <span class="aiz-square-check"></span>-->
                                <!--        </label>-->
                                <!--    </div>-->
                                <!--</div>-->
                                    <div class="col-sm-6">
                                        <div class="text-left">
                                            <a href="{{ route('password.request') }}" class="text-reset fs-14 text-cst-primary">{{translate('Forgot password ?')}}</a>
                                        </div>
                                    </div>
                            </div>
                            <button type="submit" class="btn cst-btn-primary btn-lg btn-block text-white text-uppercase">
                                {{ translate('Signin') }}
                            </button>
                            <a href="{{route('register')}}" class="btn cst-border-primary cst-hover-primary btn-lg btn-block cst-text-primary text-uppercase">
                                {{ translate('Create an Account ') }}
                            </a>
                        </form>
                        <!--@if (env("DEMO_MODE") == "On")-->
                        <!--    <div class="mt-4">-->
                        <!--        <table class="table table-bordered">-->
                        <!--            <tbody>-->
                        <!--                <tr>-->
                        <!--                    <td>admin@example.com</td>-->
                        <!--                    <td>123456</td>-->
                        <!--                    <td><button class="btn btn-info btn-xs" onclick="autoFill()">{{ translate('Copy') }}</button></td>-->
                        <!--                </tr>-->
                        <!--            </tbody>-->
                        <!--        </table>-->
                        <!--    </div>-->
                        <!--@endif-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@section('script')
    <script type="text/javascript">
        function autoFill(){
            $('#email').val('admin@example.com');
            $('#password').val('123456');
        }
    </script>
@endsection
