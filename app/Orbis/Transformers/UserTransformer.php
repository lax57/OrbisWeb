<?php
namespace App\Orbis\Transformers;

class UserTransformer extends Transformer {

    public function transform($user)
    {
        return [
            'id' => (integer)$user['id'],
            'email' => $user['email'],
        ];
    }
}