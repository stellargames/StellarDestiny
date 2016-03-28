<?php

namespace Stellar\Http\Controllers\Api;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Stellar\Contracts\CommandHandlerInterface;
use Stellar\Contracts\CommandResultInterface;
use Stellar\Http\Controllers\Controller;

class ApiController extends Controller
{

    /**
     * Handle incoming request.
     *
     * @param Request                 $request
     *
     * @param CommandHandlerInterface $handler
     *
     * @return \Illuminate\Http\Response
     */
    public function request(Request $request, CommandHandlerInterface $handler)
    {
        $command   = $request->input('command');
        $arguments = $request->input('arguments');
        $result    = $handler->handle($command, $arguments);

        $response = $this->getResponse($result);

        // Mark the response with the requestId.
        if ($request->has('requestId')) {
            $response['requestId'] = $request->input('requestId');
        }

        // Add any data.
        if ($result->hasData()) {
            $response['data'] = $result->getData();
        }

        return response()->json($response);
    }


    public function testForm(Request $request)
    {
        return view('api.testform');
    }


    /**
     * @param CommandResultInterface $result
     *
     * @return array
     */
    protected function getBasicResponse(CommandResultInterface $result)
    {
        $response = [
          'success'    => $result->succeeded(),
          'messages'   => $result->getMessages() ?: [],
          'serverTime' => Carbon::now()->toIso8601String(),
        ];

        return $response;
    }


    /**
     * @return array
     */
    protected function getEmptyResponse()
    {
        $response = [
          'success'    => false,
          'messages'   => ['No result'],
          'serverTime' => Carbon::now()->toIso8601String(),
        ];
        return $response;
    }


    /**
     * @param CommandResultInterface $result
     *
     * @return array
     */
    protected function getResponse(CommandResultInterface $result)
    {
        if ($result === null) {
            return $this->getEmptyResponse();
        }
        return $this->getBasicResponse($result);
    }
}
