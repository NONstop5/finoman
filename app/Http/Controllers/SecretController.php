<?php

namespace App\Http\Controllers;

use App\Models\Secret;
use Illuminate\Http\Request;

class SecretController extends Controller
{
    public function index(Request $request)
    {
        return Secret::all();
//        return $request->user()->secrets;
    }
}
