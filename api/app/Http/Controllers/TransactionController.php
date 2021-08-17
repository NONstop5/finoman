<?php

namespace App\Http\Controllers;

use App\Http\Filter\TransactionFilter;
use App\Http\Requests\TransactionRequest;
use App\Models\Transaction;
use App\Services\TransactionService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

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
     * @param TransactionRequest $request
     *
     * @return JsonResponse
     */
    public function store(TransactionRequest $request): JsonResponse
    {
        return response()->json($this->transactionsService->create($request->validated()), Response::HTTP_CREATED);
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
     * @param TransactionRequest $request
     * @param Transaction $transaction
     *
     * @return JsonResponse
     */
    public function update(TransactionRequest $request, Transaction $transaction): JsonResponse
    {
        return response()->json($transaction->update($request->validated()), Response::HTTP_ACCEPTED);
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
