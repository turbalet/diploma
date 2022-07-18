<?php

namespace App\Http\Controllers;

use App\Models\Speciality;
use App\Models\University;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class SpecialityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {


        $builder = Speciality::with(['program.degree', 'first_subject', 'second_subject']);
        if (($request->query('programs')) && ($request->query('programs'))[0] != "" ) {
            $v = $request->query('programs');
            $builder -> whereHas('program', function ($q) use ($v) {
                $q -> where('name', $v);
            });
        }
        if ($request->query('name') && $request->query('name') != "") {
            $builder->where('name', 'like' , '%'.$request->query('name').'%');
        }

        if(($request->query('first_subject')) && $request->query('first_subject')!= "" && $request->query('second_subject') && $request->query('second_subject')!= "") {
            $v1 = $request->query('first_subject');
            $v2 = $request->query('second_subject');

            ($builder->whereHas('second_subject', function ($q) use ($v2) {
                $q->where('name', $v2);
            })->whereHas('first_subject', function ($q) use ($v1) {
                $q->where('name', $v1);
            }))->orWhereHas('second_subject', function ($q) use ($v1) {
                $q->where('name', $v1);
            })->whereHas('first_subject', function ($q) use ($v2) {
                $q->where('name', $v2);
            });
        } elseif(($request->query('first_subject')) && $request->query('first_subject')!= "") {
            $v = $request->query('first_subject');
            $builder->whereHas('first_subject', function ($q) use ($v) {
                $q->where('name', $v);
            })->orWhereHas('second_subject', function ($q) use ($v) {
                $q->where('name', $v);
            });
        } elseif($request->query('second_subject') && $request->query('second_subject')!= "") {
            $v = $request->query('second_subject');
            $builder->whereHas('second_subject', function ($q) use ($v) {
                $q->where('name', $v);
            })->orWhereHas('first_subject', function ($q) use ($v) {
                $q->where('name', $v);
            });
        }




        if ($request->query('page') == 0) {
            return response($builder->get(), 200);
        }

        return response($builder->paginate(5), 200);
    }

    public function excludeUniversitySpecialities(Request $request, $programId, $uniId) {
        $specialities = DB::select('select s.id, s.name, s.code,s.program_id from specialities s left join university_speciality us on s.id = us.speciality_id
            and us.university_id = '.$uniId.' where us.speciality_id is null and s.program_id = '.$programId.';');


        return response($specialities, 200);
    }

    public function universitySpecialities(Request $request, $programId, $uniId) {
        $specialities = DB::select('select s.id, s.name, s.code, us.points, s.program_id from specialities s left join university_speciality us on s.id = us.speciality_id
            and us.university_id = '.$uniId.' where us.speciality_id is not null and s.program_id = '.$programId.';');


        return response($specialities, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $validation = Speciality::make($request->all(),
            [
               'name'=>'required',
                'code'=>''
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
     * @return JsonResponse
     */
    public function show($id)
    {
        $speciality = Speciality::with(['program.degree', 'first_subject', 'second_subject', 'universities.language', 'universities.type', 'universities.category', 'universities.region'])->where('id', $id)->first();
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
     * @param Request $request
     * @param  int  $id
     * @return JsonResponse
     */
    public function update(Request $request, $id)
    {
        $validation = Validator::make($request->all(),
            [
                'name'=>'',
                'code'=>''
            ]);

        if ($validation->fails()) {
            return \response()->json([
                'message' => $validation->errors()->messages()
            ], 400);
        }

        $speciality = Speciality::find($id);

        if (!$speciality) {
            return response()->json([
                'message' => "ERR_NOT_FOUND",
            ], 404);
        }

        try {
            $speciality->update($request->all());
        } catch (QueryException $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 400);
        }


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
