<?php

namespace Stellar\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use League\Fractal\Manager;
use Response;
use Stellar\Contracts\CommandHandlerInterface;
use Stellar\Http\Requests;
use Stellar\Transformers\ArraySerializer;

class ApiController extends Controller
{

    protected $fractal;


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
     * @param Request                 $request
     *
     * @param CommandHandlerInterface $handler
     *
     * @return \Illuminate\Http\Response
     */
    public function request(Request $request, CommandHandlerInterface $handler) {

        $result = $handler->handle($request->command, $request->arguments);

        // Basic response variables.
        $response = [
            'success' => $result->succeeded(),
            'messages' => $result->getMessages(),
            'serverTime' => Carbon::now()->toIso8601String(),
        ];

        // Mark the response with the requestId.
        if ($request->has('requestId')) {
            $response['requestId'] = $request->requestId;
        }

        // Use fractal to transform the returned data.
        if ($result->succeeded() && $result->hasData()) {
            foreach ($result->getData() as $key => $value) {
                $response['data'][$key] = $this->fractal->createData($value)->toArray();
            }
        }

        return Response::json($response);
    }


    public function testForm(Request $request) {
        return view('api.testform');
    }

}
