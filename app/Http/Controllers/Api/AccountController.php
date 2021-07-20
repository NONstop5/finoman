<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Account;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    /**
     * Вывод аккаунтов в зависиомсти от типа
     */

    public function index(Request $request): JsonResponse
    {
        $request->validate([
            'types_id'=>['required','max:1'],
        ]);

        $account = Account::query()
        ->select('id','name')
        ->where('user_id', Auth::id())
        ->where('types_id',$request->types_id)
        ->get();
        return response()->json($account);
    }

    /**
     * Сохранение аккаунта и правила валидации
     */

    public function store(Request $request)
    {
        $request->validate([
            'name'=>['required', 'unique:accounts,name'],
            'user_id'=>'required',
            'types_id'=>['required','max:1'],
        ]);
        return Account::create($request->all());
    }

    /**
     * Вывод аккаунта по id
     */

    public function show(Account $account): JsonResponse
    {
        return response()->json($account->toArray());
    }

    /**
     * Поиск по id и изменение имени
     */
    public function update(Request $request, Account $account)
    {
        $validated = $this->validate(
            $request,
            [
                'name' => ['required', 'unique:accounts,name'],
                'user_id'=>'required',
                'types_id'=>['required','max:1'],
            ]
        );

        $account->update($validated);

        return response()->json([], Response::HTTP_NO_CONTENT);
    }

    /**
     * Удаление аккаунта.
     */
    public function destroy(Account $account)
    {
        $account->delete();

        return response()->json([], Response::HTTP_NO_CONTENT);
    }
}
