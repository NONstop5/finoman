<?php

namespace App\Http\Controllers;

use App\Models\Wallet;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
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
     * @return void
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param Wallet $wallet
     *
     * @return void
     */
    public function show(Wallet $wallet)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Wallet $wallet
     *
     * @return void
     */
    public function update(Request $request, Wallet $wallet)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Wallet $wallet
     *
     * @return void
     */
    public function destroy(Wallet $wallet)
    {
        //
    }
}
