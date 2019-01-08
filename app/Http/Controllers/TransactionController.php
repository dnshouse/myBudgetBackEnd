<?php

namespace App\Http\Controllers;

use App\Account;
use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Account $account)
    {
        return response()->json($account->transactions, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
//            'name' => 'required|max:50',
//            'icon' => 'max:50',
//            'colour' => 'min:7|max:7',
        ]);

        $transaction = Transaction::create($request->all());

        return response()->json($transaction, 201);
    }

    /**
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        if (Auth::user()->isNot($transaction->user)) {
            abort(403);
        }

        return response()->json($transaction, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, Transaction $transaction)
    {
        if (Auth::user()->isNot($transaction->user)) {
            abort(403);
        }

        $this->validate($request, [
//            'name' => 'required|max:50',
//            'icon' => 'max:50',
//            'colour' => 'min:7|max:7',
        ]);

        $transaction->update($request->all());

        return response()->json($transaction, 200);
    }

    /**
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Transaction $transaction)
    {
        if (Auth::user()->isNot($transaction->user)) {
            abort(403);
        }

        $transaction->delete();

        return response()->json(null, 204);
    }
}
