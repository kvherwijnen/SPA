<?php

namespace App\Http\Hue;

use App\Http\Hue\Resources\HueUserResource;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class HueUser extends HueClient
{
    /**
     * Creates a new user in your Hue Bridge. When you disable force link button you will have to manually
     * press the link button on your bridge.
     *
     * It will return the username right away.
     *
     * @param null $name
     * @param bool $forceLinkButton
     *
     * @return string
     */
    public function create($name = null, $forceLinkButton = true)
    {
        if (!$name) {
            $name = Str::random(6);
        }

        if ($forceLinkButton) {
            $this->send('/bridge/0/config', 'put', ['linkbutton' => true]);
        }

        return object_get(Arr::first($this->send('/bridge', 'post', ['devicetype' => 'Artificial Intelligence' . '#' . $name])), 'success.username');
    }

    /**
     * Returns a new user in your bridge.
     *
     * @param $id
     *
     * @return HueUserResource
     */
    public function get($id)
    {
        return new HueUserResource($this->send('/bridge/' . $id . '/config'));
    }
}
