<?php

namespace Stellar\Http\Controllers\Client;

use Illuminate\Http\Request;

use Route;
use Stellar\Http\Controllers\ApiController;
use Stellar\Http\Requests;
use Stellar\Http\Controllers\Controller;

class ClientController extends Controller
{

    public function info()
    {
        $request = Request::create('api', 'POST', array('command' => 'info'));
        $response = Route::dispatch($request)->getContent();
        $data = json_decode($response);
        return view('client.info', compact('data'));
    }
}
