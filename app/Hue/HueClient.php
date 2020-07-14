<?php

namespace App\Http\Hue;

use App\Preferences;
use GuzzleHttp\Client;
use Illuminate\Support\Carbon;
use App\User;
use Illuminate\Support\Facades\Auth;

class HueClient
{
    /**
     * @var User
     */
    protected $user;
    /**
     * @var string
     */
    protected $baseUser;
    /**
     * @var Client
     */
    private $guzzle;
    /**
     * @var string
     */
    private $baseUrl = 'https://api.meethue.com';
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
        $this->baseUser = $this->preferences->hue_username;

        $this->guzzle = new Client;
    }

    /**
     * Sends a request and returns response from Hue api
     *
     * @param        $url
     * @param string $method
     * @param array  $params
     *
     * @return mixed
     */
    public function send($url, $method = 'get', $params = [])
    {
        $options = [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->refreshAndGetAccessToken(),
                'Content-Type' => 'application/json'
            ]
        ];

        if ($params)
            $options['json'] = $params;

        $r = $this->guzzle->{$method}($this->baseUrl . $url, $options);

        return json_decode($r->getBody()->getContents());
    }

    /**
     * @return mixed
     */
    public function refreshAndGetAccessToken()
    {
        // Check if the previous access token is still valid, if its valid then return it (reduces API calls)
        if (Carbon::createFromTimestamp(strtotime($this->preferences->hue_access_token_expires_at)) > Carbon::now()) {
            return $this->preferences->hue_access_token;
        }


        // If its not, request a new one
        $r = $this->guzzle->post($this->baseUrl . '/oauth2/refresh?grant_type=refresh_token', [
            'form_params' => [
                'refresh_token' => $this->preferences->hue_refresh_token,
            ],
            'headers' => [
                'Authorization' => 'Basic ' . base64_encode($this->preferences->hue_client_id . ':' . $this->preferences->hue_client_secret),
                'Content-Type' => 'application/x-www-form-urlencoded'
            ]
        ]);

        $tokens = $r->getBody()->getContents();

        $this->setTokenFile($tokens);


        return object_get(json_decode($tokens), 'access_token');
    }

    /**
     * @param $data
     *
     * @return void
     */
    public function setTokenFile($data)
    {
        $data = json_decode($data);
        $data->access_token_expires_at = Carbon::now()
            ->addSeconds($data->access_token_expires_in)
            ->format('Y-m-d H:i:s');

        $data->refresh_token_expires_at = Carbon::now()
            ->addSeconds($data->refresh_token_expires_in)
            ->format('Y-m-d H:i:s');

        $preferences = $this->preferences;
        $preferences->hue_access_token = $data->access_token;
        $preferences->hue_access_token_expires_in = $data->access_token_expires_in;
        $preferences->hue_access_token_expires_at = $data->access_token_expires_at;

        $preferences->hue_refresh_token = $data->refresh_token;
        $preferences->hue_refresh_token_expires_in = $data->refresh_token_expires_in;
        $preferences->hue_refresh_token_expires_at = $data->refresh_token_expires_at;
        $preferences->update();
    }

    /**
     * @param $code
     *
     * @return mixed
     */
    public function getAccessTokenForTheFirstTime($code)
    {
        $r = $this->guzzle->post($this->baseUrl . '/oauth2/token', [
            'query' => [
                'code' => $code,
                'grant_type' => 'authorization_code'
            ],
            'headers' => [
                'Authorization' => 'Basic ' . base64_encode($this->preferences->hue_client_id . ':' . $this->preferences->hue_client_secret),
                'Content-Type' => 'application/json'
            ]
        ]);

        $tokens = $r->getBody()->getContents();

        $this->setTokenFile($tokens);
        return json_decode($tokens);
    }

    /**
     * @return void
     */
    public function startOAuth()
    {
        $parameters = http_build_query([
            'clientid' => $this->preferences->hue_client_id,
            'appid' => 'sheep-ai',
            'deviceid' => $this->preferences->hue_device_id,
            'response_type' => 'code'
        ]);

        header('Location: ' . $this->baseUrl . '/oauth2/auth?' . $parameters);
        exit;
    }

    /**
     * @return HueBridge
     */
    public function bridge()
    {
        return new HueBridge;
    }

    /**
     * @return HueScene
     */
    public function scenes()
    {
        return new HueScene;
    }

    /**
     * @return HueEffect
     */
    public function effects()
    {
        return new HueEffect;
    }

    /**
     * @return HueLight
     */
    public function lights()
    {
        return new HueLight;
    }

    /**
     * @return HueGroups
     */
    public function groups()
    {
        return new HueGroups;
    }

    /**
     * @return HueSensor
     */
    public function sensors()
    {
        return new HueSensor;
    }

    /**
     * @return HueResourceLink
     */
    public function resourceLinks()
    {
        return new HueResourceLink;
    }

    /**
     * @return HueUser
     */
    public function users()
    {
        return new HueUser;
    }

    /**
     * @return HueSchedule
     */
    public function schedules()
    {
        return new HueSchedule;
    }
}
