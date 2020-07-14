<?php

namespace App\Http\Hue;

use App\Http\Hue\Resources\HueScheduleResource;
use Illuminate\Support\Collection;

class HueSchedule extends HueClient
{
    /**
     * Returns all the schedules in your bridge
     *
     * @return Collection
     */
    public function all()
    {
        return collect($this->send('/bridge/' . $this->baseUser . '/schedules'))
            ->map(function($item) {
                return new HueScheduleResource($item);
            });
    }

    /**
     * Returns a specific schedule object
     *
     * @param $id
     *
     * @return HueScheduleResource
     */
    public function get($id)
    {
        return new HueScheduleResource($this->send('/bridge/' . $this->baseUser . '/schedules/' . $id));
    }
}
