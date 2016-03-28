<?php

namespace Stellar\Http\Controllers\Client;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Psy\Util\Json;
use Stellar\Http\Controllers\Controller;

class ClientController extends Controller
{

    protected function makeApiCall($command, array $arguments = [])
    {
        $request  = Request::create('api', 'POST',
          ['command' => $command, 'arguments' => $arguments]);
        $handler  = app()->make('Stellar\Contracts\CommandHandlerInterface');
        $response = app('\Stellar\Http\Controllers\Api\ApiController')
          ->request($request, $handler)
          ->getContent();
        $data     = json_decode($response);

        return $data;
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
