<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Transaction;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AccountController extends Controller
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
                'type_id' => ['required', 'max:1'],
            ]
        );

        $accounts = Account::query()
            ->select('id', 'name')
            ->where('user_id', Auth::id())
            ->where('types_id', $validated['type_id'])
            ->get();

        return response()->json($accounts);
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
                'name' => ['required', 'unique:accounts,name'],
                'user_id' => 'required',
                'types_id' => ['required', 'max:1'],
            ]
        );

        return response()->json(Transaction::query()->create($validated));
    }

    /**
     * Display the specified resource.
     *
     * @param Account $account
     *
     * @return JsonResponse
     */
    public function show(Account $account): JsonResponse
    {
        return response()->json($account->toArray());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Account $account
     *
     * @return JsonResponse
     * @throws ValidationException
     */
    public function update(Request $request, Account $account): JsonResponse
    {
        $validated = $this->validate(
            $request,
            [
                'name' => ['required', 'unique:accounts,name'],
                'user_id' => 'required',
                'types_id' => ['required', 'max:1'],
            ]
        );

        return response()->json($account->update($validated));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Account $account
     *
     * @return JsonResponse
     */
    public function destroy(Account $account)
    {
        $account->delete();

        return response()->json([], Response::HTTP_NO_CONTENT);
    }
}
