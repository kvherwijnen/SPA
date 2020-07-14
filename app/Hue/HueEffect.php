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

namespace App\Http\Hue;

class HueEffect extends HueClient
{
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
    public function setScene($id, $params)
    {
        if (!$id)
            return response()->json(['No group id was given'], 500);

        if (!$params)
            return response()->json(['No scene object was given'], 500);

        return $this->send('/bridge/' . $this->baseUser . '/groups/' . $id . '/action', 'put', $params);
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
