<?php

namespace App\Http\Controllers;

use App\Models\Type;
use Illuminate\Http\Request;

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

    public function showOne($id)
    {
        return Type::where('id', $id)->first();
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

    public function destroy($id)
    {
        $type = Type::find($id);
        $type->delete();

        return $this->showAll();
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name'=>'required'
        ]);

        $type = Type::find($id);
        $type->name =  $request->get('name');
        $type->save();

        return $this->showAll();
    }
}
