<?php

namespace App\Http\Hue;

use Illuminate\Http\JsonResponse;

class HueBridge extends HueClient
{
    /**
     * Returns a bridge group object
     *
     * @return JsonResponse
     */
    public function get()
    {
        $response = $this->send('/bridge/' . $this->baseUser . '/config');

            return response()->json($response);
    }

    /**
     * Returns a bridge group object
     *
     * @return JsonResponse
     */
    public function store()
    {
        return response()->json(['error' => 'function not provided'], 400);
    }

    /**
     * Send in your partials states, you can find the parameters here:
     * https://developers.meethue.com/develop/hue-api/groupds-api/#set-gr-state
     *
     * @param $params
     *
     * @return mixed|void
     */
    public function update($params)
    {
        return $this->send('/bridge/' . $this->baseUser . '/config', 'put', $params);
    }
}
