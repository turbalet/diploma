<?php

namespace App\Http\Controllers;

use App\Models\Region;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class RegionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return response(Region::all(), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $validation = Validator::make($request->all(),
            [
                'name'=>'required'
            ]);

        if ($validation->fails()) {
            return \response()->json([
                'message' => $validation->errors()->messages()
            ], 400);
        }

        $region = new Region([
            'name' => $request->get('name')
        ]);
        $region->save();

        return response()->json($region, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Builder|Model|object
     */
    public function show($id)
    {
        $region = Region::where('id', $id)->first();
        if (!$region) {
            return response()->json([
                'message' => "ERR_NOT_FOUND",
            ], 404);
        }

        return $region;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return JsonResponse
     */
    public function update(Request $request, $id)
    {
        $validation = Validator::make($request->all(),
            [
                'name'=>'required'
            ]
        );

        if ($validation->fails()) {
            return response()->json([
                'message' => $validation->errors()->messages()
            ], 400);
        }

        $region = Region::find($id);

        if (!$region) {
            return response()->json([
                'message'=> "ERR_NOT_FOUND",
            ], 404);
        }

        $region->name =  $request->get('name');
        $region->save();

        return $region;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        $region = Region::find($id);

        if (!$region) {
            return response()->json([
                'message' => "ERR_NOT_FOUND",
            ], 404);
        }

        $region->delete();
        return response()->json([
            'message' => 'Successfully deleted'
        ]);
    }
}
