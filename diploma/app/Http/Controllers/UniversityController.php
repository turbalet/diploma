<?php

namespace App\Http\Controllers;

use App\Models\University;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UniversityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        if (($request->query('programs')) && ($request->query('programs'))[0] != "" ) {
            $builder = University::with(['region', 'category', 'type', 'language', 'programs']);
            $v = $request->query('programs');
            foreach ($v as $program) {
                $builder -> whereHas('programs', function ($q) use ($program) {
                        $q -> where('name', $program);
                });
            }
        } else {
            $builder = University::with(['region', 'category', 'type', 'language', 'programs']);
        }

        if (($request->query('name')) && $request->query('name') != "") {
            //$builder->whereFullText(['name'], $request->query('name'));
            $builder->where('name', 'LIKE', "%{$request->query('name')}%");
        }
        if ($request->query('regions') && $request->query('regions')[0] != "") {
            $v = $request->query('regions');
                $builder->whereHas('region', function ($q) use ($v) {
                    $q->whereIn('name', $v);
                });
        }
        if (($request->query('category')) && $request->query('category') != "") {
            $v = $request->query('category');
            $builder->whereHas('category', function ($q) use ($v) {
                $q->where('name', $v);
            });
        }
        if (($request->query('languages')) && $request->query('languages')[0] != "") {
            $v = $request->query('languages');

            $builder->whereHas('language', function ($q) use ($v) {
                $q->whereIn('name', $v);
            });
        }
        if (($request->query('types')) && $request->query('types')[0] != "") {
            $v = $request->query('types');
            $builder->whereHas('type', function ($q) use ($v) {
                $q->whereIn('name', $v);
            });
        }

        if ($request->query('page') == 0) {
            return response($builder->get(), 200);
        }

        return response($builder->paginate(5), 200);
    }


    public function rating(Request $request, $specialityId)
    {

        $universities = DB::select('
                select u.name as name, r.name as region, s.name as speciality, s.code as code, us.points
                from universities u
                join university_speciality us on u.id = us.university_id
                join regions r on u.region_id = r.id
                join specialities s on us.speciality_id = s.id
                where us.speciality_id = '.$specialityId.' order by us.points;
                ');

        if ($specialityId !== 0) {
            $universities = DB::table('universities', 'u')
                ->join('university_speciality', 'u.id', '=', 'university_speciality.university_id')
                ->join('regions', 'u.region_id', '=', 'regions.id')
                ->join('specialities', 'university_speciality.speciality_id', '=', 'specialities.id')
                ->select('u.name', 'regions.name as region', 'specialities.name as speciality', 'specialities.code as code', 'university_speciality.points as points')
                ->where('university_speciality.speciality_id', $specialityId);
            //->paginate(2);
        } else {
            $universities = DB::table('universities', 'u')
                ->join('university_speciality', 'u.id', '=', 'university_speciality.university_id')
                ->join('regions', 'u.region_id', '=', 'regions.id')
                ->join('specialities', 'university_speciality.speciality_id', '=', 'specialities.id')
                ->select('u.name', 'regions.name as region', 'specialities.name as speciality', 'specialities.code as code', 'university_speciality.points as points')
                ->where('university_speciality.speciality_id', '!=', 0);

        }

        if ($request->query('name') && $request->query('name')[0] != "") {
            $universities->where('u.name', 'like', '%'.$request->query('name').'%');
        }

        if ($request->query('region') && $request->query('region')[0] != "") {
            $universities->where('regions.name', $request->query('region'));
        }


        return response($universities->orderByDesc('university_speciality.points')->get(), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
//        $validation = Validator::make($request->all(),
//            [
//                'name' => 'required',
//                'description' => '',
//                'website' => '',
//                'instagram' => '',
//                'phone_number' => '',
//                'region_id' => 'required|integer',
//                'category_id' => 'required|integer',
//                'type_id' => 'required|integer',
//                'language_id' => 'required|integer',
//                'image' => ''
//            ]);
//
//        if ($validation->fails()) {
//            return \response()->json([
//                'message' => $validation->errors()->messages()
//            ], 400);
//        }

        $data = $request->all();

        if (isset($data['updated_image'])) {
            $relativePath = $this->saveImage($data['updated_image']);
            $data['banner'] = Config::get('app.host') . $relativePath;
        }
        if (isset($data['updated_logo'])) {
            $relativePath = $this->saveImage($data['updated_logo']);
            $data['logo'] = Config::get('app.host') . $relativePath;
        }
        unset($data['updated_image']);
        unset($data['updated_logo']);
        $university = University::create($data);

//
//        $university = new University([
//            'name' => $request->get('name'),
//            'description' => $request->get('description'),
//            'website' => $request->get('website'),
//            'instagram' => $request->get('instagram'),
//            'phone_number' => $request->get('phone_number'),
//            'region_id' => $request->get('region_id'),
//            'category_id' => $request->get('category_id'),
//            'type_id' => $request->get('type_id'),
//            'language_id' => $request->get('language_id')
//        ]);
//        $university->save();
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
        $university = University::with('region', 'category', 'type', 'language', 'specialities.program.degree')->where('id', $id)->first();
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
    public function update(Request $request, int $id)
    {
//        $validation = Validator::make($request->all(),
//            [
//                'name' => '',
//                'description' => '',
//                'website' => '',
//                'instagram' => '',
//                'phone_number' => '',
//                'region_id' => 'integer',
//                'category_id' => 'integer',
//                'type_id' => 'integer',
//                'language_id' => 'integer',
//                'image' => '',
//            ]);
//
//        if ($validation->fails()) {
//            return \response()->json([
//                'message' => $validation->errors()->messages()
//            ], 400);
//        }

        $data = $request->all();

        $university = University::find($id);
        if (!$university) {
            return response()->json([
                'message' => "ERR_NOT_FOUND",
            ], 404);
        }

        if (isset($data['updated_image'])) {
            $relativePath = $this->saveImage($data['updated_image']);
            $data['banner'] = Config::get('app.host') . $relativePath;
            if ($university->banner) {
                $absolutePath = public_path($university->banner);
                File::delete($absolutePath);
            }
        }

        if (isset($data['updated_logo'])) {
            $relativePath = $this->saveImage($data['updated_logo']);
            $data['logo'] = Config::get('app.host') . $relativePath;
            if ($university->logo) {
                $absolutePath = public_path($university->logo);
                File::delete($absolutePath);
            }
        }
        unset($data['programs']);
        unset($data['updated_image']);
        unset($data['updated_logo']);

        $university->update($data);
        return response()->json($university);

//        $university = University::find($id);
//
//        if (!$university) {
//            return response()->json([
//                'message' => "ERR_NOT_FOUND",
//            ], 404);
//        }
//
//        try {
//            $university->update($request->all());
//        } catch (QueryException $e) {
//            return response()->json([
//                'message' => $e->getMessage(),
//            ], 400);
//        }
//
//        return $university;
    }

    private function saveImage($image): string
    {
        // Check if image is valid base64 string
        if (preg_match('/^data:image\/(\w+);base64,/', $image, $type)) {
            // Take out the base64 encoded text without mime type
            $image = substr($image, strpos($image, ',') + 1);
            // Get file extension
            $type = strtolower($type[1]); // jpg, png, gif

            // Check if file is an image
            if (!in_array($type, ['jpg', 'jpeg', 'gif', 'png'])) {
                throw new \Exception('invalid image type');
            }
            $image = str_replace(' ', '+', $image);
            $image = base64_decode($image);

            if ($image === false) {
                throw new \Exception('base64_decode failed');
            }
        } else {
            throw new \Exception('did not match data URI with image data');
        }

        $dir = 'images/';
        $file = Str::random() . '.' . $type;
        $absolutePath = public_path($dir);
        $relativePath = $dir . $file;
        if (!File::exists($absolutePath)) {
            File::makeDirectory($absolutePath, 0755, true);
        }
        file_put_contents($relativePath, $image);

        return $relativePath;
    }

    public function updateImage(Request $request, $id): JsonResponse
    {

        $university = University::find($id);

        if (!$university) {
            return response()->json([
                'message' => "ERR_NOT_FOUND",
            ], 404);
        }
        try {
            if ($request->hasFile('file')) {
                echo "hasfile";
                $university->banner = Storage::putFile('public', $request->file('file'));
                $university->save();
            } else {
                return response()->json([
                    'message' => 'File is required',
                ], 400);
            }
        } catch (QueryException $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 400);
        }

        return \response()->json($university, 200);
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
