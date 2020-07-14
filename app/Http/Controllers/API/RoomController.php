<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Hue\HueClient;
use App\Notifications\HueNotification;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Notification;

class RoomController extends Controller
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
        return $this->Hue->groups()->all();
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
        return $this->Hue->groups()->create($request->toArray());
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     *
     * @return Collection
     */
    public function show($id)
    {
        return $this->Hue->groups()->getObject($id);
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
        $on = !$this->Hue->groups()->get($id)->getLightsOn();
        return $this->Hue->groups()->customState($id, ["on" => $on]);
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
        Notification::route('slack', env('SLACK_WEBHOOK_URL'))
            ->notify(new HueNotification($this->user,
                'Hue Sheep', ("{$this->user->name} heeft kamer *{$this->Hue->groups()->get($id)->getName()}* aangepast met de volgende informatie: \n\n\r {$request->getContent()}")));

        return $this->Hue->groups()->update($id, $request->toArray());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int     $id
     *
     * @return Response
     */
    public function updateState($id, Request $request)
    {
        return $this->Hue->groups()->customState($id, $request->toArray());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        Notification::route('slack', env('SLACK_WEBHOOK_URL'))
            ->notify(new HueNotification($this->user,
                'Hue Sheep', ("{$this->user->name} heeft kamer *{$this->Hue->groups()->get($id)->getName()}* verwijderd")));

        return $this->Hue->groups()->remove($id);
    }
}
