<?php

namespace App\Http\Controllers\Api;

use App\Orbis\Transformers\UserTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiUserController extends ApiController {
    protected $userTransformer;

    function __construct(UserTransformer $userTransformer)
    {
        $this->userTransformer = $userTransformer;
    }

    function getUser(){
        return $this->respond([
            'user' => $this->userTransformer->transform (Auth::User()),
        ],200);
    }
}
