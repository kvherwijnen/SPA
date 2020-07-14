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

namespace App\Http\Controllers\API;

use App\Http\Hue\HueClient;
use App\Preferences;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class HueController extends Controller
{
    /**
     * Initialize HueClient
     *
     * @var HueClient
     */
    private $Hue;

    /**
     * Initialize User
     *
     * @var User
     * @
     */
    private $user;

    /**
     * Initialize Preferences
     *
     * @var Preferences
     * @
     */
    private $preferences;

    public function __construct()
    {
        $this->user = User::find(Auth::id());
        $this->preferences = Preferences::find(Auth::id());
        if(!Auth::check()) {
            $this->user = User::find(1);
            $this->preferences = Preferences::find(1);
            if(!$this->preferences->hue_access_token === null && !$this->user) {
                $this->user = User::find(2);
                $this->preferences = Preferences::find(2);
                if (!$this->preferences->hue_access_token === null && !$this->user) {
                    $this->user = User::find(2);
                    $this->preferences = Preferences::find(2);
                }
            }
        }
        $this->Hue = new HueClient;
    }

    public function auth()
    {
        return redirect($this->Hue->startOAuth());
    }

    public function receive(Request $request)
    {
        if ($code = $request->input('code')) {
            $this->Hue->getAccessTokenForTheFirstTime($code);

            $username = $this->Hue->users()->create();

            return redirect()->action('\App\Http\Controllers\HueController@receive', ['username' => $username]);
        }

        // This is being triggered after we created our first user, so the developer can enter the username
        // in the .env file.
        if ($username = $request->input('username')) {
            $preferences = $this->preferences;
            $preferences->hue_username = $username;
            $preferences->update();

            return view('hue.auth', compact('username'));
        }

        // If all is well, we display a default view to show its working.
        $lights = $this->Hue->lights()->allBlade();

        return view('hue.lights', compact('lights'));
    }
}
