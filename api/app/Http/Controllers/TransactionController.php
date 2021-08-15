<?php

namespace App\Http\Controllers;

use App\Http\Filter\TransactionFilter;
use App\Models\Transaction;
use App\Services\TransactionService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class TransactionController extends Controller
{
    protected $transactionsService;

    public function __construct(TransactionService $transactionService)
    {
        $this->transactionsService = $transactionService;
    }

    public function index(TransactionFilter $filters): JsonResponse
    {
        $transactions = $this->transactionsService->getFilteredTransactions($filters);
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
