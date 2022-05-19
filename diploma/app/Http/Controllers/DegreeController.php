<?php

namespace App\Http\Controllers;

use App\Models\Degree;
use App\Models\Program;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class DegreeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return response(Degree::all(), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $request->validate([
           'name'=>'required'
        ]);

        $degree = new Degree([
            'name'=>$request->get('name')
        ]);

        $degree -> save();

        return response()->json($degree, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function show($id)
    {
        $degree = Degree::where('id', $id)->first();
        if (!$degree) {
            return response()->json([
                'message' => "ERR_NOT_FOUND",
            ], 404);
        }
        return response()->json($degree, 200);
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
                'name'=>'required',
            ]);

        if ($validation->fails()) {
            return \response()->json([
                'message' => $validation->errors()->messages()
            ], 400);
        }

        $degree = Degree::find($id);

        if (!$degree) {
            return response()->json([
                'message' => "ERR_NOT_FOUND",
            ], 404);
        }

        try {
            $degree->update($request->all());
        } catch (QueryException $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 400);
        }

        return $degree;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        $degree = Degree::find($id);

        if (!$degree) {
            return response()->json([
                'message' => "ERR_NOT_FOUND",
            ], 404);
        }

        $degree->delete();
        return response()->json([
            'message' => 'Successfully deleted'
        ]);
    }
}
