<?php

namespace App\Http\Controllers\Api;

use App\Specialty;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SpecialtiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $specialty = Specialty::all();
            return response()->json($specialty);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $specialty = new Specialty();
            $specialty->fill($request->all());
            $specialty->save();
            return response()->json($specialty, 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Specialty $specialty
     * @return \Illuminate\Http\Response
     */
    public function show(Specialty $specialty)
    {
        if (!$specialty->id) return response()->json([], 404);

        try {
            return response()->json($specialty);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Specialty $specialty
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Specialty $specialty)
    {
        try {
            $specialty->fill($request->all());
            $specialty->save();
            return response()->json($specialty, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Specialty $specialty
     * @return \Illuminate\Http\Response
     */
    public function destroy(Specialty $specialty)
    {
        try {
            Specialty::destroy($specialty->id);
            return response()->json('', 204);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
