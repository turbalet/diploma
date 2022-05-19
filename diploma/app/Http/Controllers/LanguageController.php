<?php

namespace App\Http\Controllers;

use App\Models\Language;
use App\Models\Program;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;

class LanguageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return \response(Language::all(), 200);
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

        $language = new Language([
            'name' => $request->get('name')
        ]);
        $language->save();

        return response()->json($language, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function show($id)
    {
        $language = Language::where('id', $id)->first();
        if (!$language) {
            return response()->json([
                'message' => "ERR_NOT_FOUND",
            ], 404);
        }
        return response()->json($language, 200);    }

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

        $language = Language::find($id);

        if (!$language) {
            return response()->json([
                'message' => "ERR_NOT_FOUND",
            ], 404);
        }

        try {
            $language->update($request->all());
        } catch (QueryException $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 400);
        }

        return $language;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        $language = Language::find($id);

        if (!$language) {
            return response()->json([
                'message' => "ERR_NOT_FOUND",
            ], 404);
        }

        $language->delete();
        return response()->json([
            'message' => 'Successfully deleted'
        ]);
    }
}
