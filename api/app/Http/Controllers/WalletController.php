<?php

namespace App\Http\Controllers;

use App\Http\Requests\WalletRequest;
use App\Models\Wallet;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class WalletController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     *
     * @return JsonResponse
     * @throws ValidationException
     */
    public function index(Request $request)
    {
        $validated = $this->validate(
            $request,
            [
                'wallet_type_id' => 'nullable|integer|exists:wallet_types,id',
            ]
        );

        $qb = Wallet::query()
            ->where('user_id', Auth::id());

        if (isset($validated['wallet_type_id'])) {
            $qb->where('wallet_type_id', $validated['wallet_type_id']);
        }

        $walletsList = $qb->get();

        return response()->json($walletsList);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function store(WalletRequest $request): JsonResponse
    {
        $validated = $request->validated();

        return response()->json(
            Wallet::query()
                ->create([
                    'user_id' => Auth::id(),
                    'currency_id' => 1,
                    'wallet_type_id' => $validated['wallet_type_id'],
                    'name' => $validated['name'],
                    'balance' => $validated['balance'],
                    'balance_date' => $validated['balance_date'],
                    'icon' => $validated['icon'],
                ]),
            Response::HTTP_CREATED
        );
    }

    /**
     * Display the specified resource.
     *
     * @param Wallet $wallet
     *
     * @return JsonResponse
     */
    public function show(Wallet $wallet): JsonResponse
    {
        return response()->json($wallet->toArray());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Wallet $wallet
     *
     * @return JsonResponse
     */
    public function update(WalletRequest $request, Wallet $wallet): JsonResponse
    {
        $validated = $request->validated();

        return response()->json($wallet->update([
            'wallet_type_id' => $validated['wallet_type_id'],
            'name' => $validated['name'],
            'balance' => $validated['balance'],
            'balance_date' => $validated['balance_date'],
            'icon' => $validated['icon'],
        ]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Wallet $wallet
     *
     * @return JsonResponse
     */
    public function destroy(Wallet $wallet): JsonResponse
    {
        $wallet->delete();
        return response()->json([], Response::HTTP_NO_CONTENT);
    }
}
