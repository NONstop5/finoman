<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     *
     * @return JsonResponse
     * @throws ValidationException
     */
    public function index(Request $request): JsonResponse
    {
        $validated = $this->validate(
            $request,
            [
                'date-from' => 'nullable|date',
                'date-to' => 'nullable|date',
            ]
        );

        $qb = Transaction::query()
            ->select(
                [
                    'transactions.id',
                    'transaction_type_id',
                    'wallet_from_id',
                    'wallet_to_id',
                    'category_id',
                    'amount',
                    'transacted_at',
                ]
            )
            ->with(
                [
                    'transactionType:transaction_types.id,transaction_types.name',
                    'walletFrom:wallets.id,wallets.name',
                    'walletTo:wallets.id,wallets.name',
                    'category:categories.id,categories.name',
                ]
            )
            ->join('users', 'users.id', '=', 'transactions.user_id');

        if (isset($validated['date-from'])) {
            $qb->whereDate('transacted_at', '>=', $validated['date-from']);
        }

        if (isset($validated['date-to'])) {
            $qb->whereDate('transacted_at', '<=', $validated['date-to']);
        }

        $transactionList = $qb->get();

        return response()->json($transactionList);
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
