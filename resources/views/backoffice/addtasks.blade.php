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
            <form action="{{route('addtask') }}" class="login-form" method="post">
                <h3 class="form-title font-red">Dodaj zadania</h3>
                @if(count($errors)>0)
                <div class="alert alert-danger">
                    <button class="close" data-close="alert"></button>
                    <span>{{trans('register_page.data_error') }} </span>
                </div>
                @endif
                <div class="form-group">
                    <label class="control-label">Lekcja ID</label>
                    <input class="form-control form-control-solid placeholder-no-fix" id="lesson" name="lesson" placeholder="Lekcja ID" type="text" />
                </div>


                <div>
                    <row>
                        <div class="col-md-6">
                            <input class="form-control form-control-solid placeholder-no-fix" id="task" name="task_1" placeholder="Polecenie" type="text" />
                        </div>

                        <div class="col-md-6">
                            <input class="form-control form-control-solid placeholder-no-fix" id="answer" name="answer_1" placeholder="Odpowiedź" type="text" />
                        </div>
                    </row>

                    <row>
                        <div class="col-md-6">
                            <input class="form-control form-control-solid placeholder-no-fix" id="task" name="task_2" placeholder="Polecenie" type="text" />
                        </div>

                        <div class="col-md-6">
                            <input class="form-control form-control-solid placeholder-no-fix" id="answer" name="answer_2" placeholder="Odpowiedź" type="text" />
                        </div>
                    </row>

                    <row>
                        <div class="col-md-6">
                            <input class="form-control form-control-solid placeholder-no-fix" id="task" name="task_3" placeholder="Polecenie" type="text" />
                        </div>

                        <div class="col-md-6">
                            <input class="form-control form-control-solid placeholder-no-fix" id="answer" name="answer_3" placeholder="Odpowiedź" type="text" />
                        </div>
                    </row>

                    <row>
                        <div class="col-md-6">
                            <input class="form-control form-control-solid placeholder-no-fix" id="task" name="task_4" placeholder="Polecenie" type="text" />
                        </div>

                        <div class="col-md-6">
                            <input class="form-control form-control-solid placeholder-no-fix" id="answer" name="answer_4" placeholder="Odpowiedź" type="text" />
                        </div>
                    </row>

                    <row>
                        <div class="col-md-6">
                            <input class="form-control form-control-solid placeholder-no-fix" id="task" name="task_5" placeholder="Polecenie" type="text" />
                        </div>

                        <div class="col-md-6">
                            <input class="form-control form-control-solid placeholder-no-fix" id="answer" name="answer_5" placeholder="Odpowiedź" type="text" />
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

