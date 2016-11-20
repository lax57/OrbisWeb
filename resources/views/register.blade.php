@extends('layouts.master')

@section('title')
    Orbis Languages
@endsection

@section('body')
<body class="login">
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
            <form action="{{route('signup') }}" class="login-form" method="post">
                <h3 class="form-title font-red">{{trans('register_page.new_account') }}</h3>
                @if(count($errors)>0)
                <div class="alert alert-danger">
                    <button class="close" data-close="alert"></button>
                    <span>{{trans('register_page.data_error') }} </span>
                </div>
                @endif
                <div class="form-group">
                    <label class="control-label">{{trans('register_page.email') }}</label>
                    <input class="form-control form-control-solid placeholder-no-fix" id="email" name="email" placeholder="{{trans('login_page.email') }}" type="text" />
                </div>
                <div class="form-group">
                    <label class="control-label">{{trans('register_page.password') }}</label>
                    <input class="form-control form-control-solid placeholder-no-fix" id="password" name="password" placeholder="{{trans('login_page.password') }}" type="password" />
                </div>
                <div class="form-group">
                    <label class="control-label">{{trans('register_page.confirm_password') }}</label>
                    <input class="form-control form-control-solid placeholder-no-fix" id="password_confirmation" name="password_confirmation" placeholder="{{trans('login_page.password') }}" type="password" />
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn red btn-outline uppercase">Zarejestruj</button>
                </div>
                <input type="hidden" name="_token" value="{{ Session::token() }}" />
            </form>
        </div>
    </div>
</body>
@endsection
