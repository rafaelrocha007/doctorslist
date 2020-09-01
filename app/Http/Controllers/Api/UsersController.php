<?php

namespace App\Http\Controllers\Api;

use App\Doctor;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $users = User::all();
            return response()->json($users);
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
            $user = new User();
            $user->fill($request->all());
            $password = $request->password;
            $user->password = Hash::make($password);
            $user->save();
            return response()->json($user, 201);
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
            return response()->json($doctor);
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
    public function update(Request $request, Doctor $Doctor)
    {
        try {
            $doctor = new Doctor();
            $doctor->fill($request->all());
            $doctor->save();
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
    public function destroy(Doctor $Doctor)
    {
        //
    }
}
