<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\Division;
use App\Models\Union;
use App\Models\Upazilla;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BdLocationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function divisions(Request $request)
    {
        $divisions = Division::orderBy('name', 'ASC')->get();

        if ($divisions) {
            return response()->json([
                'status' => true,
                'divisions' => $divisions,
                'message' => $divisions->count() . ' divisions found'
            ]);
        }

        return response()->json([
            'status' => false,
            'divisions' => null,
            'message' => 'No data found'
        ]);

    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function districts(Request $request)
    {
        $districts = District::orderBy('name', 'ASC')->get();

        if ($request->input('division_id')) {
            $districts = $districts->where('division_id', $request->input('division_id'));
        }

        if ($districts) {
            return response()->json([
                'status' => true,
                'districts' => $districts,
                'message' => $districts->count() . ' districts found'
            ]);
        }

        return response()->json([
            'status' => false,
            'districts' => null,
            'message' => 'No data found'
        ]);

    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function upazillas(Request $request)
    {
        $upazillas = Upazilla::orderBy('name', 'ASC')->get();

        if ($request->input('district_id')) {
            $upazillas = $upazillas->where('district_id', $request->input('district_id'));
        }

        if ($upazillas) {
            return response()->json([
                'status' => true,
                'upazillas' => $upazillas,
                'message' => $upazillas->count() . ' upazillas found'
            ]);
        }

        return response()->json([
            'status' => false,
            'upazillas' => null,
            'message' => 'No data found'
        ]);

    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function unions(Request $request)
    {
        if (!$request->input('upazila_id')) {
            return response()->json([
                'status' => false,
                'unions' => null,
                'message' => 'No data found'
            ]);
        }

        $unions = Union::where('upazilla_id', $request->input('upazila_id'))->orderBy('name', 'ASC')->get();

        if ($unions->isNotEmpty()) {
            return response()->json([
                'status' => true,
                'unions' => $unions,
                'message' => $unions->count() . ' unions found'
            ]);
        }

        return response()->json([
            'status' => false,
            'unions' => null,
            'message' => 'No data found'
        ]);

    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function unionsByUpazilaId(Request $request)
    {
        if ($request->input('upazilla_id')) {
            $unions = Union::where('upazilla_id', $request->input('upazilla_id'))->get();
        }

        if ($unions) {
            return response()->json([
                'status' => true,
                'unions' => $unions,
                'message' => $unions->count() . ' unions found'
            ]);
        }

        return response()->json([
            'status' => false,
            'unions' => null,
            'message' => 'No data found'
        ]);

    }
}
