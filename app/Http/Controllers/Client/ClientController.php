<?php

namespace Stellar\Http\Controllers\Client;

use Auth;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Redis;
use Psy\Util\Json;
use Stellar\Http\Controllers\Controller;

class ClientController extends Controller
{

    protected $token;


    protected function makeApiCall($command, array $arguments = [])
    {
        $token    = $this->authenticate();
        $client   = new Client([
          'base_uri' => config('app.url') . '/api/v1/',
          'headers'  => [
            'Accept'        => 'application/json',
            'Authorization' => 'Bearer ' . $token,
          ],
        ]);
        $response = $client->request('POST', 'command', ['command' => $command, 'arguments' => $arguments]);

        //$request = Request::create('api/v1/command', 'POST', ['command' => $command, 'arguments' => $arguments]);
        //$request->headers->add(['Authorization' => 'Bearer ' . $token]);
        //$handler  = app()->make('Stellar\Contracts\CommandHandlerInterface');
        //$response = app('\Stellar\Http\Controllers\Api\ApiController')->request($request, $handler)->getContent();

        $json = $response->getBody()->getContents();

        return json_decode($json);
    }


    protected function authenticate()
    {
        if ($this->token === null) {
            $this->token = Auth::guard('api')->login(request()->user());
        }
        return $this->token;
    }


    /**
     * @param $player
     *
     * @return mixed
     */
    protected function getStarMap($player)
    {
        $location = $player->ship->location;
        $key      = 'ls:' . $player->ship->name . ':starmap';
        $json     = Redis::get($key);
        $starMap  = (array)json_decode($json);

        if (!array_key_exists($location->name, $starMap)) {
            $starMap[$location->name] = $location->exits;
            $json                     = Json::encode($starMap);
            Redis::set($key, $json);
        }

        return $starMap;
    }

}
