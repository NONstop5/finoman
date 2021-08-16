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
        return response()->json($this->walletService->getList($request->validated()));
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
        return response()->json($this->walletService->create($request->validated()), Response::HTTP_CREATED);
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
        return response()->json($wallet->update($request->validated()), Response::HTTP_ACCEPTED);
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
