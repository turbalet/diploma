<?php

namespace App\Http\Controllers;

use App\Models\Program;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response(Program::with('specialities')->get(), 200);
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
                'name'=>'required',
                'code'=>'required',
                'points'=>'required|integer',
                'grantsQuantity'=>'required|integer',
                'degreeId' => 'required|integer'
            ]);

        if ($validation->fails()) {
            return \response()->json([
                'message' => $validation->errors()->messages()
            ], 400);
        }


        $program = new Program([
            'name' => $request->get('name'),
            'code' => $request->get('code'),
            'points' => $request->get('points'),
            'grants_quantity' => $request->get('grantsQuantity'),
            'degreeId' => $request->get('degreeId')
        ]);

        $program -> save();

        return response()->json($program, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function show($id)
    {
        $program = Program::with('specialities')->where('id', $id)->first();
        if (!$program) {
            return response()->json([
                'message' => "ERR_NOT_FOUND",
            ], 404);
        }
        return response()->json($program, 200);
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
                'name'=>'',
                'code'=>'',
                'points'=>'integer',
                'grantsQuantity'=>'integer',
                'degreeId' => 'integer'
            ]);

        if ($validation->fails()) {
            return \response()->json([
                'message' => $validation->errors()->messages()
            ], 400);
        }

        $program = Program::find($id);

        if (!$program) {
            return response()->json([
                'message' => "ERR_NOT_FOUND",
            ], 404);
        }

        try {
            $program->update($request->all());
        } catch (QueryException $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 400);
        }

        return $program;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        $program = Program::find($id);

        if (!$program) {
            return response()->json([
                'message' => "ERR_NOT_FOUND",
            ], 404);
        }

        $program->delete();
        return response()->json([
            'message' => 'Successfully deleted'
        ]);
    }
}
