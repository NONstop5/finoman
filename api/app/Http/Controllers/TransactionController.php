<?php

namespace App\Http\Controllers;

use App\Http\Filter\TransactionFilter;
use App\Models\Transaction;
use App\Models\Wallet;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class TransactionController extends Controller
{

    public function index(TransactionFilter $filters): JsonResponse
    {
        $transactions = Transaction::filter($filters)->select(
            [
                'id',
                'user_id',
                'wallet_from_id',
                'wallet_to_id',
                'category_id',
                'amount',
                'transacted_at',
                'transaction_type_id'
            ]
        )
            ->with(
                [
                    'walletFrom:id,name',
                    'walletTo:id,name',
                    'category:id,name',
                    'transactionType:id,name'
                ]
            )
            ->where('user_id', Auth::id())
            ->get();

        $transactions['total'] = $transactions->sum('amount');
        return response()->json($transactions);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     *
     * @return JsonResponse
     * @throws ValidationException
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $this->validate(
            $request,
            [
                'account_from_id' => 'required|integer|exists:transactions',
                'account_to_id' => 'required|integer|exists:transactions',
                'amount' => 'required|numeric',
                'transacted_at' => 'required|date',
            ]
        );

        Transaction::query()->create($validated);

        return response()->json(Transaction::query()->create($validated));
    }

    /**
     * Display the specified resource.
     *
     * @param Transaction $transaction
     *
     * @return JsonResponse
     */
    public function show(Transaction $transaction): JsonResponse
    {
        return response()->json($transaction->toArray());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Transaction $transaction
     *
     * @return JsonResponse
     * @throws ValidationException
     */
    public function update(Request $request, Transaction $transaction): JsonResponse
    {
        $validated = $this->validate(
            $request,
            [
                'account_from_id' => 'nullable|integer|exists:transactions',
                'account_to_id' => 'nullable|integer|exists:transactions',
                'amount' => 'nullable|numeric',
                'transacted_at' => 'nullable|date',
            ]
        );

        return response()->json($transaction->update($validated));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Transaction $transaction
     *
     * @return JsonResponse
     */
    public function destroy(Transaction $transaction): JsonResponse
    {
        $transaction->delete();

        return response()->json([], Response::HTTP_NO_CONTENT);
    }
}
