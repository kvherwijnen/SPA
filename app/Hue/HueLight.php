<?php

namespace App\Http\Hue;

use App\Http\Hue\Resources\HueLightResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;


class HueLight extends HueClient
{
    /**
     * Returns all the lights in your bridge
     *
     * @return JsonResponse
     */
    public function all()
    {
        $all = $this->send('/bridge/' . $this->baseUser . '/lights');
        $lights = array();

        foreach($all as $key => $value){
            $value->id = (int)$key;

            array_push($lights, new HueLightResource($value));
        }

        return response()->json($lights, 200);
    }

    /**
     * Returns all the lights in your bridge
     *
     * @return array
     */
    public function allBlade()
    {
        $all = $this->send('/bridge/' . $this->baseUser . '/lights');
        $lights = array();
        $i = 1;

        foreach($all as $item) {
            $item->id = $i;
            array_push($lights, new HueLightResource($item));
            $i = $i+1;
        }

        return $lights;
    }

    /**
     * Returns a specific light object
     *
     * @param null $id
     *
     * @return HueLightResource
     */
    public function get($id)
    {
        $arr = collect($this->send('/bridge/' . $this->baseUser . '/lights/' . $id))
            ->map(function($item) {
                return $item;
            });
        return new HueLightResource($arr);
    }

    /**
     * Returns a specific light object
     *
     * @param null $id
     *
     * @return Collection
     */
    public function getObject($id)
    {
        return collect($this->send('/bridge/' . $this->baseUser . '/lights/' . $id))
            ->map(function($item) {
                return $item;
            });
    }

    /**
     * Toggle the light from parameter
     *
     * @param $id
     *
     * @param $on
     *
     * @return mixed|void
     */
    public function toggle($id, $on)
    {
        return $this->send('/bridge/' . $this->baseUser . '/lights/' . $id . '/state', 'put', [
            'on' => $on
        ]);
    }


    /**
     * Change the light state to off
     *
     * @param $id
     *
     * @return mixed|void
     */
    public function off($id)
    {
        if (!$id) {
            return;
        }

        return $this->send('/bridge/' . $this->baseUser . '/lights/' . $id . '/state', 'put', [
            'on' => false
        ]);
    }

    /**
     * Change the light state to on
     *
     * @param $id
     *
     * @return mixed|void
     */
    public function on($id)
    {
        if (!$id) {
            return;
        }

        return $this->send('/bridge/' . $this->baseUser . '/lights/' . $id . '/state', 'put', [
            'on' => true
        ]);
    }

    /**
     * Make the light do a specific 'breathe' animation
     *
     * @param $id
     *
     * @return mixed|void
     */
    public function breathe($id)
    {
        if (!$id) {
            return;
        }

        return $this->send('/bridge/' . $this->baseUser . '/lights/' . $id . '/state', 'put', [
            'alert' => 'select'
        ]);
    }

    /**
     * Send in your custom states, you can find the parameters here:
     * https://developers.meethue.com/develop/hue-api/lights-api/#set-light-state
     *
     * @param $id
     * @param $params
     *
     * @return mixed|void
     */
    public function customState($id, $params)
    {
        if (!$id) {
            return;
        }

        return $this->send('/bridge/' . $this->baseUser . '/lights/' . $id . '/state', 'put', $params);
    }
}
