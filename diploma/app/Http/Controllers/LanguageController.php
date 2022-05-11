<?php

namespace App\Http\Controllers;

use App\Models\Language;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
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
        return Language::all();
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
        return $this->index();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Builder|Model|object
     */
    public function show($id)
    {
        return Language::where('id', $id)->first();
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
        $request->validate([
            'name'=>'required'
        ]);

        $language = Language::find($id);
        $language->name =  $request->get('name');
        $language->save();

        return $this->index();
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
