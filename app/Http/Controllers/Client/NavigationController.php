<?php

namespace Stellar\Http\Controllers\Client;

class NavigationController extends ClientController
{
    public function index() {
        $data = $this->makeApiCall('navigation');

        // Star map.
        $data->starMap = $this->getStarMap($data);

        return view('client.navigation', compact('data'));
    }

    public function jump() {
        $data = $this->makeApiCall('jump');
    }


}
