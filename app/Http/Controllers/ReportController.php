<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function index(): JsonResponse
    {
        $transactions = Account::query()
            ->select('*')
            ->join('transactions', function($join){
                $join
                    ->on('account_from_id', '=', 'accounts.id')
                    ->orOn('account_to_id', '=', 'accounts.id');
            })
            ->where('user_id', Auth::id())
            ->get();
        return response()->json($transactions);
    }

}
