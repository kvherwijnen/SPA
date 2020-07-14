<?php
/**
 * :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
 *
 * Copyright (c) 2020
 * All Rights Reserved
 * Licensed use only
 *
 * This product is part of the SheepCompany Incorporated
 *
 *
 * LICENSE BY:
 * Artificial Intelligence :: Sheep-AI.com
 * More information: LICENSE.txt
 *
 * :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
 */

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\User;
use App\Preferences;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    public function __invoke()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $users = User::all();

        return response()->json(
            ['status' => 'success', 'users' => $users->toArray()], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     *
     * @return Response
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
        ]);

        return User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $user = User::find($id);

        return response()->json(['status' => 'success', 'user' => $user->toArray()
            ], 200);
    }

    /**
     * Check the specified resource exists.
     *
     * @param $username
     *
     * @return JsonResponse
     */
    public function check($username)
    {
        if (User::all()->contains('name', $username))
            return response()->json(['Already used'], 400);

        else return response()->json(['Valid'], 200);
    }

    /**
     *
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int     $id
     *
     * @return JsonResponse
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update($request->all());

        $preferences = Preferences::findOrFail($id);
        $preferences->update($request->all());

        return response()->json($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return JsonResponse
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json(null, 204);
    }
}
