<?php

namespace Stellar\Http\Controllers\Client;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Psy\Util\Json;
use Stellar\Http\Controllers\Controller;
use Stellar\Http\Requests;

class ClientController extends Controller
{

    protected function makeApiCall($command, $arguments = [ ]) {
        $request  = Request::create('api', 'POST', [ 'command' => $command, 'arguments' => $arguments]);
        $handler  = app()->make('Stellar\Contracts\CommandHandler');
        $response = app('\Stellar\Http\Controllers\ApiController')->request($request, $handler)->getContent();
        $data     = json_decode($response);

        return $data;
    }


    /**
     * @param $player
     *
     * @return mixed
     */
    protected function getStarMap($player) {
        $location = $player->ship->location;
        $key      = 'ls:' . $player->ship->name . ':starmap';
        $json     = Redis::get($key);
        $starMap  = (array) json_decode($json);
        if ( ! isset($starMap[$location->name])) {
            $starMap[$location->name] = $location->exits;
            $json                     = Json::encode($starMap);
            Redis::set($key, $json);
        }

        return $starMap;
    }

}
