<?php

namespace Stellar\Http\Controllers\Client;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Route;
use Stellar\Http\Controllers\Controller;
use Stellar\Http\Requests;

class ClientController extends Controller
{

    public function info() {
        $data = $this->makeApiCall('info');

        return view('client.info', compact('data'));
    }


    public function navigation() {
        $data         = $this->makeApiCall('navigation');
        Redis::set('localStorage:star:' . $data->ship->location->name, $data->ship->location->exits);
        $localStorage = Redis::get('localStorage:star');
        dd($localStorage);

        return view('client.navigation', compact('data'));
    }


    protected function makeApiCall($command) {
        $request  = Request::createFromBase(Request::create('api', 'POST', [ 'command' => $command ]));
        $response = Route::dispatch($request)->getContent();
        $data     = json_decode($response);

        return $data->user;
    }

}
