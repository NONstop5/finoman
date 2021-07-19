<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Обработка попыток аутентификации.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');
return response($credentials);
        if (Auth::attempt($credentials)) {
            // $request->session()->regenerate();

            return response('SUCCESS');
        }

        return response(
            [
                'errors' => [
                    'email' => 'The provided credentials do not match our records.',
                ],
            ]
        );
    }
}
