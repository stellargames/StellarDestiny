<?php

namespace Stellar\Http\Controllers\Client;

class InfoController extends ClientController
{
    public function index() {
        $data = $this->makeApiCall('info');
        return view('client.info', compact('data'));
    }
}
