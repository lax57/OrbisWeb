@extends('layouts.master')

@section('title')
    Orbis Languages
@endsection

@section('body')
<body class = "login">


    <!-- BEGIN LOGIN -->
    <div class="login">
        <div class="logo">
            <div class="page-logo">
                <i class="fa fa-globe fa-6x login" aria-hidden="true">rbis</i>
                <div class="menu-toggler sidebar-toggler">
                    <span></span>
                </div>
            </div>
        </div>
        <div class="content">
            <!-- BEGIN LOGIN FORM -->
            <form action="{{ route('signin') }}" class="login-form" method="post" novalidate="novalidate">
                <h3 class="form-title font-red">Sign In</h3>
                @if(count($errors)>0)
                <div class="alert alert-danger">
                    <button class="close" data-close="alert"></button>
                    <span>Enter any username and password. </span>
                </div>
                @endif
                <div class="form-group">
                    <label class="control-label visible-ie8 visible-ie9">Username</label>
                    <input class="form-control form-control-solid placeholder-no-fix" data-val="true" data-val-required="The User email field is required." id="email" name="email" placeholder="Email" type="text" value="" />
                </div>
                <div class="form-group">
                    <label class="control-label visible-ie8 visible-ie9">Password</label>
                    <input class="form-control form-control-solid placeholder-no-fix" data-val="true" data-val-required="The Password field is required." id="password" name="password" placeholder="Password" type="password" value="" />
                </div>
                <span></span>
                <div class="form-actions">
                    <button type="submit" class="btn red btn-outline uppercase">Login</button>
                    <label class="rememberme check mt-checkbox mt-checkbox-outline">
                        <input data-val="true" data-val-required="The RememberMe field is required." id="RememberMe" name="RememberMe" type="checkbox" value="true" />
                        <input name="RememberMe" type="hidden" value="false" />Remember
                        <span></span>
                    </label>

                    <a href="#" class="forget-password">Forgot Password?</a>
                </div>
                <input type="hidden" name="_token" value="{{ Session::token() }}" />
            </form><!-- END LOGIN FORM -->
        </div>
    </div>
</body>
@endsection
