<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Auth;
use Hash;
use http\Client\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;

class UserController extends Controller
{
    /**
     * @param UserRequest $request
     *
     * @return JsonResponse
     */
    public function register(UserRequest $request): JsonResponse
    {
        $validated = $request->validated();

        return response()->json(
            User::query()
                ->create(
                    [
                        'name' => $validated['name'],
                        'email' => $validated['email'],
                        'password' => Hash::make($validated['password']),
                    ]
                )
            ,
            Response::HTTP_CREATED
        );
    }

    /**
     * @param UserRequest $request
     *
     * @return JsonResponse
     */
    public function login(UserRequest $request)
    {
        $validated = $request->validated();

        if (Auth::attempt(Arr::only($validated, ['email', 'password']))) {
            /** @var User $user */
            $user = Auth::user();
            $success['token'] = $user->createToken('Finoman')->plainTextToken;
            $success['user'] = $user;

            return response()->json($success);
        } else {
            return response()->json('Unauthenticated', Response::HTTP_FORBIDDEN);
        }
    }

    /**
     * @param Request $request
     */
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
    }
}
