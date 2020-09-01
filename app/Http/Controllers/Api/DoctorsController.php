<?php

namespace App\Http\Controllers\Api;

use App\Doctor;
use App\Http\Controllers\Controller;
use App\Specialty;
use Illuminate\Http\Request;

class DoctorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {

            if ($request->search) {
                $doctors = Doctor::query()->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('crm', 'like', '%' . $request->search . '%')->get();
            } else {
                $doctors = Doctor::all();
            }

            return response()->json($doctors->toArray());
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
            $doctor = new Doctor();
            $doctor->fill($request->only(['name', 'crm', 'phone']));

            if (count($request->specialties) < 2)
                return response()->json(['error' => 'At least 2 specialties required'], 400);

            $doctor->save();

            $specialties = Specialty::find($request->specialties);
            $doctor->specialties()->attach($specialties);

            return response()->json($doctor, 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Doctor $Doctor
     * @return \Illuminate\Http\Response
     */
    public function show(Doctor $doctor)
    {
        if (!$doctor->id) return response()->json([], 404);

        try {
            return response()->json($doctor->toArray());
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Doctor $Doctor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Doctor $doctor)
    {
        try {
            $doctor->fill($request->only(['name', 'crm', 'phone']));

            if (count($request->specialties) < 2)
                return response()->json(['error' => 'At least 2 specialties required'], 400);

            $doctor->save();

            $doctor->specialties()->detach();
            $specialties = Specialty::find($request->specialties);
            $doctor->specialties()->attach($specialties);

            return response()->json($doctor, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Doctor $Doctor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Doctor $doctor)
    {
        try {
            Doctor::destroy($doctor->id);
            return response()->json('', 204);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
