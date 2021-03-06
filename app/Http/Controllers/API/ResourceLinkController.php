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
use App\Http\Hue\HueClient;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResourceLinkController extends Controller
{
    /**
     * Initialize HueClient
     *
     * @var $Hue
     */
    private $Hue;

    private $user;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->user = auth()->user();

        $this->Hue = new HueClient;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        return $this->Hue->resourceLinks()->all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        return response()->json(['error' => 'This function is not available yet'], 403);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return JsonResponse
     */
    public function show($id)
    {
        return response()->json(['error' => 'This function is not available yet'], 403);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int     $id
     *
     * @return JsonResponse
     */
    public function update(Request $request, $id)
    {
        return response()->json(['error' => 'This function is not available yet'], 403);
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
        return response()->json(['error' => 'This function is not available yet'], 403);
    }

}
