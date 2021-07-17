<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
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
                    'id',
                    'account_from_id',
                    'account_to_id',
                    'amount',
                    'transacted_at',
                ]
            )
            ->with(
                [
                    'accountFrom:id,name',
                    'accountTo:id,name',
                ]
            )
            ->whereHas(
                'accountFrom',
                function (Builder $query) {
                    $query->where('user_id', Auth::id());
                }
            );

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

        return response()->json([], Response::HTTP_NO_CONTENT);
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

        $transaction->update($validated);

        return response()->json([], Response::HTTP_NO_CONTENT);
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
