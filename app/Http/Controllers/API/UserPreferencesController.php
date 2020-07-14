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
use App\Preferences;
use App\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class UserPreferencesController extends Controller
{
    public function __invoke()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = User::latest()->get();
        return Preferences::find($user->id);
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
            'user_id' => 'required',
        ]);

        return Preferences::create([
            'user_id' => $request['user_id'],
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
        return Preferences::find($id);
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
        $preferences = Preferences::find($id);
        $preferences->update($request->all());

        return response()->json($preferences, 200);
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
        $user_preferences = Preferences::find($id);
        $user_preferences->delete();

        return response()->json(null, 204);
    }
}
