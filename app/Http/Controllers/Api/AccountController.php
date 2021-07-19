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
     * когда будет готов реквест надо будет
     * расскоментировать
     * ->where('types_id',$request->types_id)
     */

    public function index(Request $request): JsonResponse
    {
    $account = Account::query()
        ->select('id','name')
        ->where('user_id', Auth::id())
        /*->where('types_id',$request->types_id)*/
        ->get();
    return response()->json($account);
    }

    /**
     * Сохранение аккаунта и правила валидации
     */

    public function store(Request $request)
    {
        $request->validate([
            'name'=>['required', 'unique:users,name'],
            'user_id'=>'required',
            'types_id'=>['required','max:1'],
        ]);
        return Account::create($request->all());
    }

    /**
     * Вывод аккаунта по id
     */
    public function show($id)
    {
     return Account::findOrFail($id);
    }

    /**
     * Поиск по id и изменение имени
     */
    public function update(Request $request, $id)
    {
        $account = Account::findOrFail($id);
        if (isset($request->name)) {
            $account->name=$request->name;
        }
        $account->save();
        return $account;
    }

    /**
     * Удаление аккаунта.
     */
    public function destroy($id)
    {
        return Account::destroy($id);
    }
}
