<?php

namespace App\Http\Controllers;

use App\Models\Type;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return response(Type::all(), 200);
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
            ]
        );

        if ($validation->fails()) {
            return response()->json([
                'message' => $validation->errors()->messages()
            ], 400);
        }

        $type = new Type([
            'name' => $request->get('name')
        ]);

        $type->save();

        return response()->json($type, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Builder|Model|object
     */
    public function show($id)
    {
       $type = Type::where('id', $id)->first();
       if (!$type) {
           return response()->json([
               'message' => "ERR_NOT_FOUND",
           ], 404);
       }
       return response()->json($type, 200);
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
        ]);

        if ($validation->fails()) {
            return \response()->json([
                'message' => $validation->errors()->messages()
            ], 400);
        }

        $type = Type::find($id);

        if (!$type) {
            return response()->json([
                'message' => "ERR_NOT_FOUND",
            ], 404);
        }

        try {
            $type->update($request->all());
        } catch (QueryException $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 400);
        }

        return response()->json($type, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        $type = Type::find($id);

        if (!$type) {
            return response()->json([
                'message' => "ERR_NOT_FOUND",
            ], 404);
        }

        $type->delete();
        return response()->json([
            'message' => 'Successfully deleted'
        ]);
    }
}
