<?php

namespace App\Http\Controllers;

use App\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    /**
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Auth::user()->accounts, 200);
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $attributes = $this->validate($request, [
            'opening_balance' => 'required',
            'name' => 'required|max:50',
            'icon' => 'max:50',
            'colour' => 'min:7|max:7',
        ]);
        $attributes['user_id'] = Auth::user()->id;

        $account = Account::create($attributes);

        return response()->json($account, 201);
    }

    /**
     * @param  \App\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function show(Account $account)
    {
        if (Auth::user()->isNot($account->user)) {
            abort(403);
        }

        return response()->json($account, 200);
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Account  $account
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, Account $account)
    {
        if (Auth::user()->isNot($account->user)) {
            abort(403);
        }

        $attributes = $this->validate($request, [
            'opening_balance' => 'required',
            'name' => 'required|max:50',
            'icon' => 'max:50',
            'colour' => 'min:7|max:7',
        ]);
        $attributes['user_id'] = Auth::user()->id;

        $account->update($attributes);

        return response()->json($account, 200);
    }

    /**
     * @param  \App\Account  $account
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Account $account)
    {
        if (Auth::user()->isNot($account->user)) {
            abort(403);
        }

        $account->delete();

        return response()->json(null, 204);
    }
}
