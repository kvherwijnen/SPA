<?php

namespace App\Http\Hue;

use Illuminate\Http\JsonResponse;

class HueScene extends HueClient
{

    /**
     * Returns a scene object
     *
     * @return JsonResponse
     */
    public function get()
    {
        $response = $this->send('/bridge/' . $this->baseUser . '/scenes');

        if ($response)
            return response()->json($response, 200);

        else
            return response()->json(['error' => $response], 400);
    }

    /**
     * Save a scene object
     *
     * @return JsonResponse
     */
    public function store()
    {
        return response()->json(['error' => 'function not provided'], 403);
    }

    /**
     * Updates a Scene object
     *
     * @param $params
     *
     * @return mixed|void
     */
    public function update($params)
    {
        return $this->send('/bridge/' . $this->baseUser . '/scenes', 'put', $params);
    }
}
