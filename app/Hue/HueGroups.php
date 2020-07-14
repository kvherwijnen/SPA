<?php

namespace App\Http\Hue;

use App\Http\Hue\Resources\HueGroupResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Collection;

class HueGroups extends HueClient
{
    public function find($param)
    {
        if (!$param)
            return null;

        // TODO: Make more types
        // For now we only want the types to be Rooms.
        // Not all other groups, unless params are set
        $all = collect($this->send('/bridge/' . $this->baseUser . '/groups'))
            ->map(function($item) {
                return new HueGroupResource($item);
            });

        return $this->all()->where('name', $param);
    }

    /**
     * Returns all the groups in this bridge
     *
     * TODO: Make more types
     * For now we only want the types to be Rooms.
     * Not all other groups, unless params are set
     *
     *
     * @param string $type
     *
     * @return JsonResponse
     */
    public function all($type = 'Room')
    {
        $all = $this->send('/bridge/' . $this->baseUser . '/groups');
        $rooms = array();

        foreach($all as $key => $value){
            $value->id = (int)$key;

            if($value->type === $type) {
                array_push($rooms, new HueGroupResource($value));
            }
        }

        return response()->json($rooms, 200);
    }

    /**
     * Returns a specific group object
     *
     * @param null $id
     *
     * @return HueGroupResource
     */
    public function get($id)
    {
        $arr = collect($this->send('/bridge/' . $this->baseUser . '/groups/' . $id))
            ->map(function($item) {
                return $item;
            });
        return new HueGroupResource($arr);
    }

    /** Returns a specific group object
     *
     * @param $params
     *
     * @return JsonResponse
     */
    public function create($params)
    {
        if (!$params) {
            return Response()->json(['No body object'], 400);
        }
        return $this->send('/bridge/' . $this->baseUser . '/groups', 'post', $params);
    }


    /**
     * Returns a specific group object
     *
     * @param int  $id
     *
     * @param null $param
     *
     * @return Collection
     */
    public function getObject($id, $param = null)
    {
        if (!$param)
            return collect($this->send('/bridge/' . $this->baseUser . '/groups/' . $id))
                ->map(function($item) {
                    return $item;
                });
        else
            return collect($this->send('/bridge/' . $this->baseUser . '/groups/' . $id))->only($param)
                ->map(function($item) {
                    return $item;
                });
    }

    /**
     * Send in your partials states, you can find the parameters here:
     * https://developers.meethue.com/develop/hue-api/groupds-api/#set-gr-state
     *
     * @param $id
     * @param $params
     *
     * @return mixed|void
     */
    public function customState($id, $params)
    {
        if (!$id)
            return response()->json(['No group id was given'], 500);

        return $this->send('/bridge/' . $this->baseUser . '/groups/' . $id . '/action', 'put', $params);
    }

    /**
     * Send in your partials states, you can find the parameters here:
     * https://developers.meethue.com/develop/hue-api/groupds-api/#set-gr-state
     *
     * @param $id
     * @param $params
     *
     * @return mixed|void
     */
    public function update($id, $params)
    {
        if (!$id)
            return response()->json(['No group id was given'], 500);

        return $this->send('/bridge/' . $this->baseUser . '/groups/' . $id, 'put', $params);
    }

    /**
     * Remove hue group
     * https://developers.meethue.com/develop/hue-api/groupds-api/#del-group
     *
     * @param $id
     *
     * @return mixed|void
     */
    public function remove($id)
    {
        if (!$id)
            return response()->json(['No group id was given'], 500);

        return $this->send('/bridge/' . $this->baseUser . '/groups/' . $id, 'delete');
    }
}
