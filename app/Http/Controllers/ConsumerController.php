<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\DataResource;
use App\Models\Consumer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\QueryBuilder\QueryBuilder;

class ConsumerController extends Controller
{
    public function login(LoginRequest $request): \Illuminate\Http\JsonResponse|DataResource
    {
        $user = QueryBuilder::for(Consumer::class)
            ->where('email', $request->input('email'))
            ->where('password', $request->input('password'))
            ->first();
        if ($user){
            return new DataResource($user);
        }
        else{
            return response()->json(['message' => 'Invalid credentials!'], 422);
        }
    }

    public function register(RegisterRequest $request): \Illuminate\Http\JsonResponse|DataResource
    {
        $password=bcrypt($request->input('password'));
        $request->merge([
            'password' => $password,
        ]);
        $user = Consumer::create($request->validated());
        if($user){
            return new DataResource($user);
        }
        else{
            return  response()->json(['message'=>'Not registered successfully!'],500);
        }
    }
}
