<?php

namespace Stellar\Http\Controllers;

use Illuminate\Http\Request;
use Stellar\Http\Requests;

class ApiController extends Controller
{

    /**
     * Handle incoming request.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function request(Request $request) {
        $player = auth()->user()->load(
            [
                'ship.type',
                'ship.location.exits',
                'ship.location.ships',
                'ship.location.traders',
                'ship.items',
            ]
        );

        $response = [
            'user' => $player,
        ];

        return $response;
    }


    public function testForm(Request $request) {
        return view('api.testform');
    }

}
