@extends('layouts.dashboard')

@section('page-content')
<div class="page-content-wrapper">
    <div id="page-content" class="page-content" style="min-height:509px">

        <div class="page-title">
            @include('includes.filterbar', ['title' => trans('navbar.available_courses')])
        </div>
        @include('includes.coursegrid')
        <?php


        $translations = App\Word::find(1)->translations;

        foreach ($translations as $t) {
            $transleted_word = App\Word::find($t->word_to_id);
            echo $transleted_word->word . "<br>";
        }



       // $word = App\Word::all()->where('id', 1)->first(); $language = App\Language::find($word->language); echo $language->name;
          //  $translations = $word->translations();



        ?>



    </div>
</div>
@endsection
