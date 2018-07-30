<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function __construct()
    {

        $this->middleware('auth');
        $this->middleware('admin');
    }


    public function index()
    {
        $categories = Category::all();
      //  dd($categories);
        return view('categories.index', ['categories'=>$categories]);

    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {

      //  dd($request);
        $this->validate(request(), ['category' => 'required']);

        Category::create([
          'category' => request('category')
        ]);

        return back();
    }


    public function show(category $category)
    {
        //
    }


    public function edit(category $category)
    {
        //
    }


    public function update(Request $request, category $category)
    {
        //
    }


    public function destroy(Request $request, $id)
    {
        //todo create constraint ondelete and try catch them
        Category::destroy($id);
        return back();
    }
}
