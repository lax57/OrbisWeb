<?php

namespace App\Orbis\Transformers;
use App\Word;

class RepetitionTransformer extends Transformer {

    public function transform($repetition)
    {
        return [
            'id' => (integer)$repetition['id'],
            'word' => $repetition->excercise['word'],
            'translation'=> Word::where('id', (integer)$repetition->excercise->translations->first()['word_to_id'])->first()['word'],
        ];
    }


}



