<?php

namespace App\Http\Controllers;

use App\Models\University;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
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
    public function index(Request $request)
    {
        $builder = University::with(['region', 'category', 'type', 'language']);

        if (($request->query('name')) && $request->query('name') != "") {
            //$builder->whereFullText(['name'], $request->query('name'));
            $builder->where('name', 'LIKE', "%{$request->query('name')}%");
        }
        if ($request->query('region') && $request->query('region')!= "") {
            $v = $request->query('region');
            $builder->whereHas('region', function ($q) use ($v) {
                $q->where('name', $v);
            });
        }
        if (($request->query('category')) && $request->query('category')!= "") {
            $v = $request->query('category');
            $builder->whereHas('category', function ($q) use ($v) {
                $q->where('name', $v);
            });
        }
        if (($request->query('language')) && $request->query('language')!= "") {
            $v = $request->query('language');

            $builder->whereHas('language', function ($q) use ($v) {
                $q->where('name', $v);
            });
        }
        if (($request->query('type')) && $request->query('type')!= "") {
            $v = $request->query('type');
            $builder->whereHas('type', function ($q) use ($v) {
                $q->where('name', $v);
            });
        }

        return response($builder->paginate(2), 200);
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
                'name' => 'required',
                'description' => '',
                'website' => '',
                'instagram' => '',
                'phoneNumber' => '',
                'regionId' => 'required|integer',
                'categoryId' => 'required|integer',
                'typeId' => 'required|integer',
                'languageId' => 'required|integer'
            ]);

        if ($validation->fails()) {
            return \response()->json([
                'message' => $validation->errors()->messages()
            ], 400);
        }

        $university = new University([
            'name' => $request->get('name'),
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
     * @param int $id
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
     * @param int $id
     * @return JsonResponse
     */
    public function update(Request $request, $id)
    {
        $validation = Validator::make($request->all(),
            [
                'name' => '',
                'description' => '',
                'website' => '',
                'instagram' => '',
                'phoneNumber' => '',
                'regionId' => 'integer',
                'categoryId' => 'integer',
                'typeId' => 'integer',
                'languageId' => 'integer'
            ]);

        if ($validation->fails()) {
            return \response()->json([
                'message' => $validation->errors()->messages()
            ], 400);
        }

        $university = University::find($id);

        if (!$university) {
            return response()->json([
                'message' => "ERR_NOT_FOUND",
            ], 404);
        }

        try {
            $university->update($request->all());
        } catch (QueryException $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 400);
        }

        return $university;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
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
