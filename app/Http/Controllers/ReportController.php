<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function index(): JsonResponse
    {
        $transactions = Account::query()
            ->select()
            ->join('transactions', function(JoinClause $join){
                $join
                    ->on('account_from_id', '=', 'accounts.id')
                    ->orOn('account_to_id', '=', 'accounts.id');
            })
            ->where('user_id', Auth::id())
            ->get();
        return response()->json($transactions);
    }

}
