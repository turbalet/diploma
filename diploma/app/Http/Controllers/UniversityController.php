<?php

namespace App\Http\Controllers;

use App\Models\University;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class UniversityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return response(University::with('region', 'category', 'type', 'language')->get(), 200);
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
                'description'=>'required',
                'website'=>'required',
                'instagram'=>'required',
                'phoneNumber'=>'required',
                'regionId'=>'required|integer',
                'categoryId'=>'required|integer',
                'typeId'=>'required|integer',
                'languageId'=>'required|integer'
            ]);

        if ($validation->fails()) {
            return \response()->json([
                'message' => $validation->errors()->messages()
            ], 400);
        }

        $university = new University([
            'name'=> $request->get('name'),
            'description' => $request->get('description'),
            'website' => $request->get('website'),
            'instagram' => $request->get('instagram'),
            'phone_number' => $request->get('phoneNumber'),
            'region_id' => $request->get('regionId'),
            'category_id' => $request->get('categoryId'),
            'type_id' => $request->get('typeId'),
            'language_id' => $request->get('languageId')
        ]);
        $university->save();
        return response()->json($university, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Builder|Model|object
     */
    public function show($id)
    {
        $university = University::with('region', 'category', 'type', 'language', 'specialities')->where('id', $id)->first();
        if (!$university) {
            return response()->json([
                'message' => "ERR_NOT_FOUND",
            ], 404);
        }
        return $university;
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
            'description'=>'required',
            'website'=>'required',
            'instagram'=>'required',
            'phoneNumber'=>'required',
            'regionId'=>'required|integer',
            'categoryId'=>'required|integer',
            'typeId'=>'required|integer',
            'languageId'=>'required|integer'
        ]);

        if ($validation->fails()) {
            return \response()->json([
                'message' => $validation->errors()->messages()
            ], 400);
        }

        $university = University::find($id);

        if(!$university) {
            return response()->json([
                'message' => "ERR_NOT_FOUND",
            ], 404);
        }

        $university->name = $request->get('name');
        $university->description = $request->get('description');
        $university->website = $request->get('website');
        $university->instagram = $request->get('instagram');
        $university->phone_number = $request->get('phoneNumber');
        $university->region_id = $request->get('regionId');
        $university->category_id = $request->get('categoryId');
        $university->type_id = $request->get('typeId');
        $university->language_id = $request->get('languageId');



        $university->save();

        return $university;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        $university = University::find($id);

        if (!$university) {
            return response()->json([
                'message' => "ERR_NOT_FOUND",
            ], 404);
        }

        $university->delete();
        return response()->json([
            'message' => 'Successfully deleted'
        ]);
    }
}
