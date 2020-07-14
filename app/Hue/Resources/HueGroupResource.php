<?php

namespace App\Http\Hue\Resources;


class HueGroupResource
{
    public function __construct($data = null)
    {
        foreach ($data as $key => $val) {
            if ($key === 'class')
                $this->icon = $val;

            else $this->$key = $val;
        }
    }

    public function getName()
    {
        return $this->name;
    }

    public function getLightsOn()
    {
        return $this->state->on;
    }
}
