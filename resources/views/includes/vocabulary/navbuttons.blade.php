<div class="btn-group btn-group-justified excercise-nav">
    <a href="#" id="finish-excercise" class="btn btn-primary">
        <span>Zakończ</span>
        <i class="fa fa-times-circle-o " aria-hidden="true"></i>
    </a>
    <a id="dontknow" class="btn btn-primary @if(!$dontknow) btn-inactive @endif">Nie umiem</a>
    <a id="check" class="btn btn-primary @if(!$check) btn-inactive @endif">Sprawdź</a>
    <a id="know" class="btn btn-primary @if(!$know) btn-inactive @endif">Umiem</a>
    <a id="next" class="btn btn-primary @if(!$next) btn-inactive @endif">
        <span>Dalej</span>
        <i class="fa fa-angle-double-right fa-2" aria-hidden="true"></i>
    </a>
</div>