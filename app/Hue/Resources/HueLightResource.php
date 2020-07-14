<?php

namespace App\Http\Hue\Resources;

class HueLightResource extends BaseHueResource
{

    public function isLightOn()
    {
        return $this->state->on;
    }


    public function getName()
    {
        return $this->name;
    }
}
