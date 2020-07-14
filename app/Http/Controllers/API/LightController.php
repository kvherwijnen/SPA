<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Hue\HueClient;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;

class LightController extends Controller
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
        $collection = $this->Hue->lights()->all();

        return $collection;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return JsonResponse
     */
    public function create()
    {
        return response()->json(['error' => 'This function is not available yet'], 403);
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
     * @return Collection
     */
    public function show($id)
    {
        return $this->Hue->lights()->getObject($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        return $this->Hue->lights()->on($id);
    }

    /**
     * Toggle on/off state of the light
     *
     * @param int $id
     *
     * @return Response
     */
    public function toggle($id)
    {
        $on = !$this->Hue->lights()->get($id)->isLightOn();
        $response = $this->Hue->lights()->toggle($id, $on);

        return $response;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int     $id
     *
     * @return Response
     */
    public function update($id, Request $request)
    {
        return $this->Hue->lights()->customState($id, $request->toArray());
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
