@extends('layouts.master')

@section('title')
    Orbis Languages
@endsection

@section('body')
<body class = "login">
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
            <form action="{{route('signin') }}" class="login-form" method="post">
                <h3 class="form-title font-red">{{trans('login_page.sign_in') }}</h3>
                @if(count($errors)>0)
                <div class="alert alert-danger">
                    <button class="close" data-close="alert"></button>
                    <span>{{trans('login_page.data_error') }}</span>
                </div>
                @endif
                <div class="form-group">
                    <label class="control-label">{{trans('login_page.email') }}</label>
                    <input class="form-control form-control-solid placeholder-no-fix" id="email" name="email" placeholder="{{trans('login_page.email') }}" type="text" />
                </div>
                <div class="form-group">
                    <label class="control-label">{{trans('login_page.password') }}</label>
                    <input class="form-control form-control-solid placeholder-no-fix" id="password" name="password" placeholder="{{trans('login_page.password') }}" type="password" />
                </div>
                <span></span>
                <div class="form-actions">
                    <button type="submit" class="btn red btn-outline uppercase">{{trans('login_page.sign_in_button') }}</button>
                    <label class="rememberme check mt-checkbox mt-checkbox-outline">
                        <input data-val="true" type="checkbox" value="true" />
                        <input name="RememberMe" type="hidden" value="false" />{{trans('login_page.remember') }}
                        <span></span>
                    </label>

                    <a href="#" class="forget-password">{{trans('login_page.new_account') }}</a>
                </div>
                <input type="hidden" name="_token" value="{{ Session::token() }}" />
            </form>
        </div>
    </div>
</body>
@endsection
