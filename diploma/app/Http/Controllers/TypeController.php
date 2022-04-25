<?php

namespace App\Http\Controllers;

use App\Models\Type;

class TypeController extends Controller
{
    public function create()
    {
        dd('Creating type');
    }

    public function showAll()
    {
        return Type::all();
    }

    public function showOne(Request $request)
    {
        $request->validate([
            'id'=>'required'
        ]);
        return Type::where('id', $request->get('id'))->first();
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required'
        ]);

        $type = new Type([
            'name' => $request->get('name')
        ]);
        $type->save();
        return $this->showAll();
    }

    public function destroy(Request $request)
    {
        $type = Type::find($request->get('id'));
        $type->delete();

        return $this->showAll();
    }


    public function update(Request $request)
    {
        $request->validate([
            'id'=>'required',
            'name'=>'required'
        ]);

        $type = Type::find($request->get('id'));
        $type->name =  $request->get('name');
        $type->save();

        return $this->showAll();
    }
}
