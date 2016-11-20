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
        <div class="content" style="width:600px">
            <form action="{{route('addword') }}" class="login-form" method="post">
                <h3 class="form-title font-red">Dodaj słownictwo</h3>
                @if(count($errors)>0)
                <div class="alert alert-danger">
                    <button class="close" data-close="alert"></button>
                    <span>{{trans('register_page.data_error') }} </span>
                </div>
                @endif
                <div class="form-group">
                    <label class="control-label">Kurs ID</label>
                    <input class="form-control form-control-solid placeholder-no-fix" id="course" name="course" placeholder="ID Kursu" type="text" />
                </div>
                <div class="form-group">
                    <label class="control-label">Lekcja ID</label>
                    <input class="form-control form-control-solid placeholder-no-fix" id="lesson" name="lesson" placeholder="Lekcja ID" type="text" />
                </div>

                <div class="form-group">
                    <label class="control-label">ID języka bazowego</label>
                    <input class="form-control form-control-solid placeholder-no-fix" id="from_lang" name="from_lang" placeholder="ID jezyka bazowego" type="text" />
                </div>
                <div class="form-group">
                    <label class="control-label">ID języka docelowego</label>
                    <input class="form-control form-control-solid placeholder-no-fix" id="to_lang" name="to_lang" placeholder="ID jezyka docelowego" type="text" />
                </div>

                <div>
                    <row>
                        <div class="col-md-6">
                            <input class="form-control form-control-solid placeholder-no-fix" id="word" name="word_1" placeholder="Słowo" type="text" />
                        </div>

                        <div class="col-md-6">
                            <input class="form-control form-control-solid placeholder-no-fix" id="translation" name="translation_1" placeholder="Tłumaczenie" type="text" />
                        </div>
                    </row>

                    <row>
                        <div class="col-md-6">
                            <input class="form-control form-control-solid placeholder-no-fix" id="word" name="word_2" placeholder="Słowo" type="text" />
                        </div>

                        <div class="col-md-6">
                            <input class="form-control form-control-solid placeholder-no-fix" id="translation" name="translation_2" placeholder="Tłumaczenie" type="text" />
                        </div>
                    </row>

                    <row>
                        <div class="col-md-6">
                            <input class="form-control form-control-solid placeholder-no-fix" id="word" name="word_3" placeholder="Słowo" type="text" />
                        </div>

                        <div class="col-md-6">
                            <input class="form-control form-control-solid placeholder-no-fix" id="translation" name="translation_3" placeholder="Tłumaczenie" type="text" />
                        </div>
                    </row>

                    <row>
                        <div class="col-md-6">
                            <input class="form-control form-control-solid placeholder-no-fix" id="word" name="word_4" placeholder="Słowo" type="text" />
                        </div>

                        <div class="col-md-6">
                            <input class="form-control form-control-solid placeholder-no-fix" id="translation" name="translation_4" placeholder="Tłumaczenie" type="text" />
                        </div>
                    </row>

                    <row>
                        <div class="col-md-6">
                            <input class="form-control form-control-solid placeholder-no-fix" id="word" name="word_5" placeholder="Słowo" type="text" />
                        </div>

                        <div class="col-md-6">
                            <input class="form-control form-control-solid placeholder-no-fix" id="translation" name="translation_5" placeholder="Tłumaczenie" type="text" />
                        </div>
                    </row>

                </div>





                <div class="form-actions">
                    <button type="submit" class="btn red btn-outline uppercase">Dodaj</button>
                </div>
                <input type="hidden" name="_token" value="{{ Session::token() }}" />
            </form>
        </div>
    </div>
</body>
@endsection

