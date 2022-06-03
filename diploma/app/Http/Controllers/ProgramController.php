<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\University;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $builder = Program::with(['degree','first_subject', 'second_subject']);

        if ($request->query('name') && $request->query('name') != "") {
            $builder->where('name', $request->query('name'));
        }

        if (($request->query('degree')) && $request->query('degree')!= "") {
            $v = $request->query('degree');
            $builder->whereHas('degree', function ($q) use ($v) {
                $q->where('name', $v);
            });
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

        if (!$request->query('page') || $request->query('page')== 0) {
            return response($builder->get(), 200);
        }

        return response($builder->paginate(5), 200);
    }

    public function excludeUniversityPrograms(Request $request, $id)
    {
        $builder = Program::with(['degree','first_subject', 'second_subject']);

        $programs = DB::select('select p.id, p.name, p.code from programs p left join university_program up on p.id = up.program_id
    and up.university_id = '.$id.' where up.program_id is null');


        return response($programs, 200);
    }

    public function universityPrograms(Request $request, $id)
    {
        $builder = Program::with(['degree','first_subject', 'second_subject']);

        $programs = DB::select('select p.id, p.name, p.code from programs p left join university_program up on p.id = up.program_id
    and up.university_id = '.$id.' where up.program_id is not null');


        return response($programs, 200);
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
                'degreeId' => 'required|integer',
                'firstSubject' => 'required|integer',
                'secondSubject' => 'required|integer',
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
            'degree_id' => $request->get('degreeId'),
            'first_subject' => $request->get('firstSubject'),
            'second_subject' => $request->get('secondSubject')

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
        $program = Program::with(['degree', 'specialities', 'first_subject', 'second_subject'])->where('id', $id)->first();
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
                'degreeId' => 'integer',
                'firstSubject' => 'integer',
                'secondSubject' => 'integer',
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
