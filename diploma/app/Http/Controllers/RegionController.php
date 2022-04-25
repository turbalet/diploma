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

    public function showOne(Request $request)
    {
        $request->validate([
            'id'=>'required'
        ]);
        return Region::where('id', $request->get('id'))->first();
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

    public function destroy(Request $request)
    {
        $region = Region::find($request->get('id'));
        $region->delete();

        return $this->showAll();
    }


    public function update(Request $request)
    {
        $request->validate([
            'id'=>'required',
            'name'=>'required'
        ]);

        $region = Region::find($request->get('id'));
        $region->name =  $request->get('name');
        $region->save();

        return $this->showAll();
    }
}
