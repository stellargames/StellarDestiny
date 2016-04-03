<?php

namespace Stellar\Http\Controllers\Client;

class InfoController extends ClientController
{

    public function index()
    {
        $response = $this->makeApiCall('info');
        $player   = $response->data->player;
        $messages = $response->messages;
        
        return view('client.info', compact('player', 'messages'));
    }
}
