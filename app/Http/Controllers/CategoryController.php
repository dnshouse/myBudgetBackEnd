<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    /**
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Auth::user()->categories, 200);
    }

    /**
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $attributes = $this->validate($request, [
            'name' => 'required|max:50',
            'icon' => 'max:50',
            'colour' => 'min:7|max:7',
        ]);
        $attributes['user_id'] = Auth::user()->id;

        $category = Category::create($attributes);

        return response()->json($category, 201);
    }

    /**
     * @param  \App\Category $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        if (Auth::user()->isNot($category->user)) {
            abort(403);
        }

        return response()->json($category, 200);
    }

    /**
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Category $category
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, Category $category)
    {
        if (Auth::user()->isNot($category->user)) {
            abort(403);
        }

        $attributes = $this->validate($request, [
            'name' => 'required|max:50',
            'icon' => 'max:50',
            'colour' => 'min:7|max:7',
        ]);
        $attributes['user_id'] = Auth::user()->id;

        $category->update($attributes);

        return response()->json($category, 200);
    }

    /**
     * @param  \App\Category $category
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Category $category)
    {
        if (Auth::user()->isNot($category->user)) {
            abort(403);
        }

        $category->delete();

        return response()->json(null, 204);
    }
}
