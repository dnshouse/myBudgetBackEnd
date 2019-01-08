<?php

namespace App\Http\Controllers;

use App\Budget;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class BudgetController extends Controller
{
    /**
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Auth::user()->budgets, 200);
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $attributes = $this->validate($request, [
            'category_id' => 'required',
            'amount' => 'required|integer',
            'time_frame' => [
                'required',
                Rule::in(array_keys(Budget::timeFrames()))
            ],
        ]);
        $attributes['user_id'] = Auth::user()->id;

        $budget = Budget::create($attributes);

        return response()->json($budget, 201);
    }

    /**
     * @param  \App\Budget  $budget
     * @return \Illuminate\Http\Response
     */
    public function show(Budget $budget)
    {
        if (Auth::user()->isNot($budget->user)) {
            abort(403);
        }

        return response()->json($budget, 200);
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Budget  $budget
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, Budget $budget)
    {
        if (Auth::user()->isNot($budget->user)) {
            abort(403);
        }

        $attributes = $this->validate($request, [
            'category_id' => 'required',
            'amount' => 'required|integer',
            'time_frame' => [
                'required',
                Rule::in(array_keys(Budget::timeFrames()))
            ],
        ]);
        $attributes['user_id'] = Auth::user()->id;

        $budget->update($attributes);

        return response()->json($budget, 200);
    }

    /**
     * @param  \App\Budget  $budget
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Budget $budget)
    {
        if (Auth::user()->isNot($budget->user)) {
            abort(403);
        }

        $budget->delete();

        return response()->json(null, 204);
    }
}
