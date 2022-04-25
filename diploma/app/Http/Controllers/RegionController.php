<?php

namespace App\Http\Controllers;

use App\Models\Region;
use Illuminate\Http\Request;

class RegionController extends Controller
{
    public function create()
    {
        dd('Creating region');
    }

    public function showAll()
    {
        return Region::all();
    }

    public function showOne($id)
    {
//        $request->validate([
//            'id'=>'required'
//        ]);
//        $request->get('id')
        return Region::where('id', $id)->first();
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required'
        ]);

        $region = new Region([
            'name' => $request->get('name')
        ]);
        $region->save();
        return $this->showAll();
    }

    public function destroy($id)
    {
        $region = Region::find($id);
        $region->delete();

        return $this->showAll();
    }


    public function update(Request $request,$id)
    {
        $request->validate([
            'name'=>'required'
        ]);

        $region = Region::find($id);
        $region->name =  $request->get('name');
        $region->save();

        return $this->showAll();
    }
}
