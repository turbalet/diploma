<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function create()
    {
        dd('Creating category');
    }

    public function showAll()
    {
        return Category::all();
    }

    public function showOne(Request $request)
    {
        $request->validate([
            'id'=>'required'
        ]);
        return Category::where('id', $request->get('id'))->first();
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required'
        ]);

        $category = new Category([
            'name' => $request->get('name')
        ]);
        $category->save();
        return $this->showAll();
    }

    public function destroy(Request $request)
    {
        $category = Category::find($request->get('id'));
        $category->delete();

        return $this->showAll();
    }


    public function update(Request $request)
    {
        $request->validate([
            'id'=>'required',
            'name'=>'required'
        ]);

        $category = Category::find($request->get('id'));
        $category->name =  $request->get('name');
        $category->save();

        return $this->showAll();
    }
}
