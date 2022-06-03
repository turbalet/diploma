<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {

        if ($request->query('name') && $request->query('name') != "") {
            return response(Category::all()->where('name', $request->query('name')));
        }

        return response(Category::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
//        $validation = Category::make($request->all(),[
//            'name'=>'required'
//        ]);
//
//        if ($validation->fails()) {
//            return response()->json([
//                'message' => $validation->errors()->messages()
//            ], 400);
//        }

        $category = Category::create($request->all());
        return response()->json($category, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function show($id)
    {
        $category = Category::where('id', $id)->first();
        if (!$category) {
            return response()->json([
                'message' => "ERR_NOT_FOUND",
            ], 404);
        }
        return response()->json($category, 200);

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

        $category = Category::find($id);

        try {
            $category->update($request->all());
        } catch (QueryException $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 400);
        }

        return response()->json($category, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json([
                'message' => "ERR_NOT_FOUND",
            ], 404);
        }

        $category->delete();
        return response()->json([
            'message' => 'Successfully deleted'
        ]);
    }
}
