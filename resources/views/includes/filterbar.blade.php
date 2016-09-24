<div class="row">
    <div class="col-sm-2">
        <h3 class="text-center">{{$title}}</h3>
    </div>

    <div class="col-sm-6">
        <div id="name-filter" class="course-filter" data-filter-group="lang">
            <button class="filter active" data-filter="*">{{trans('filter_bar.all') }}</button>
            @foreach($unique_languages as $language)
            <button class="filter" data-filter=".lang_{{$language}}">{{$language}}</button>
            @endforeach
        </div>
    </div>

    <div class="col-sm-4">
        <div id="level-filter" class="course-filter" data-filter-group="level">
            <button class="item active" data-filter="*">{{trans('filter_bar.all') }}</button>
            @foreach($unique_levels as $level)
            <button class="filter" data-filter=".{{$level}}">{{$level}}</button>
            @endforeach

        </div>
    </div>
</div>