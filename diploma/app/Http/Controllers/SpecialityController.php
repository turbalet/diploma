<?php

namespace App\Http\Controllers;

use App\Models\Speciality;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class SpecialityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response(Speciality::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validation = Speciality::make($request->all(),
            [
               'name'=>'required',
                'code'=>'required'
            ]
        );

        if ($validation->fails()) {
            return response()->json([
                'message' => $validation->errors()->messages()
            ], 400);
        }

        $speciality = new Speciality([
            'name' => $request->get('name'),
            'code' => $request->get('code')
        ]);

        $speciality->save();

        return response()->json($speciality, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Builder|Model|object
     */
    public function show($id)
    {
        $speciality = Speciality::where('id', $id)->first();
        if (!$speciality) {
            return response()->json([
                'message' => "ERR_NOT_FOUND",
            ], 404);
        }
        return response()->json($speciality, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return JsonResponse
     */
    public function update(Request $request, $id)
    {
        $validation = Validator::make($request->all(),
            [
                'name'=>'required',
                'code'=>'required'
            ]);

        if ($validation->fails()) {
            return \response()->json([
                'message' => $validation->errors()->messages()
            ], 400);
        }

        $speciality = Speciality::find($id);
        $speciality->name =  $request->get('name');
        $speciality->code = $request->get('code');
        $speciality->save();

        return response()->json($speciality, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        $speciality = Speciality::find($id);

        if (!$speciality) {
            return response()->json([
                'message' => "ERR_NOT_FOUND",
            ], 404);
        }

        $speciality->delete();
        return response()->json([
            'message' => 'Successfully deleted'
        ]);
    }
}
