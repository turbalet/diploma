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

    public function showOne($id)
    {
        return Category::where('id', $id)->first();
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

    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();

        return $this->showAll();
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name'=>'required'
        ]);

        $category = Category::find($id);
        $category->name =  $request->get('name');
        $category->save();

        return $this->showAll();
    }
}
