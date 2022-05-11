<?php

namespace App\Http\Controllers;

use App\Models\Type;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return Type::all();
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

        $type = new Type([
            'name' => $request->get('name')
        ]);
        $type->save();
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
        return Type::where('id', $id)->first();
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

        $type = Type::find($id);
        $type->name =  $request->get('name');
        $type->save();

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
