<?php

namespace Stellar\Http\Controllers\Client;

class NavigationController extends ClientController
{

    public function index()
    {
        $response = $this->makeApiCall('info');

        $player = $response->data->player;

        // Star map.
        $starMap = $this->getStarMap($player);

        return view('client.navigation', compact('starMap', 'player'));
    }


    public function jump()
    {
        $data = $this->makeApiCall('jump');
        dd($data);
    }

}
