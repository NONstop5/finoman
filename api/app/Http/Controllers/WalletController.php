<?php

namespace App\Http\Controllers;

use App\Http\Requests\WalletRequest;
use App\Models\Wallet;
use App\Services\WalletService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class WalletController extends Controller
{
    /**
     * @var WalletService
     */
    protected $walletService;

    public function __construct(WalletService $walletService)
    {
        $this->walletService = $walletService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param WalletRequest $request
     *
     * @return JsonResponse
     */
    public function index(WalletRequest $request)
    {
        $validated = $request->validated();
        $wallets = $this->walletService->getList($validated);

        return response()->json($wallets);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param WalletRequest $request
     *
     * @return JsonResponse
     */
    public function store(WalletRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $wallet = $this->walletService->create($validated);

        return response()->json($wallet, Response::HTTP_CREATED);
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
     * @param WalletRequest $request
     * @param Wallet $wallet
     *
     * @return JsonResponse
     */
    public function update(WalletRequest $request, Wallet $wallet): JsonResponse
    {
        $validated = $request->validated();
        $wallet = $wallet->update($validated);

        return response()->json($wallet, Response::HTTP_ACCEPTED);
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
