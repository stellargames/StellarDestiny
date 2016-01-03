<?php

namespace Stellar\Http\Controllers;

use Illuminate\Http\Request;
use League\Fractal\Manager;
use League\Fractal\Resource\Item;
use League\Fractal\Serializer\ArraySerializer;
use Response;
use Stellar\Http\Requests;
use Stellar\Transformers\UserTransformer;

class ApiController extends Controller
{

    /**
     * ApiController constructor.
     *
     * @param Manager $fractal
     */
    public function __construct(Manager $fractal) {
        $fractal->setSerializer(new ArraySerializer());
        $this->fractal = $fractal;
    }


    /**
     * Handle incoming request.
     *
     * @param Request         $request
     *
     * @return \Illuminate\Http\Response
     */
    public function request(Request $request) {
        $player = auth()->user();


        $item = new Item($player, new UserTransformer);
        $data = $this->fractal->createData($item)->toArray();
        return Response::json($data);
    }


    public function testForm(Request $request) {
        return view('api.testform');
    }

}
