<?php

namespace Stellar\Http\Controllers\Api;

use Carbon\Carbon;
use Illuminate\Http\Request;
use League\Fractal\Manager;
use Stellar\Api\CommandResultInterface;
use Stellar\Api\Transformers\ArraySerializer;
use Stellar\Contracts\CommandHandlerInterface;
use Stellar\Http\Controllers\Controller;

class ApiController extends Controller
{

    protected $dataTransformer;


    /**
     * ApiController constructor.
     *
     * @param Manager $fractal
     */
    public function __construct(Manager $fractal)
    {
        $fractal->setSerializer(new ArraySerializer());
        $this->dataTransformer = $fractal;
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
    public function request(Request $request, CommandHandlerInterface $handler)
    {
        $player    = $request->user('api');
        $command   = $request->input('command', 'info');
        $arguments = $request->input('arguments', []);
        $result    = $handler->handle($player, $command, $arguments);

        $response = $this->getResponse($result);

        // Mark the response with the requestId.
        if ($request->has('requestId')) {
            $response['requestId'] = $request->input('requestId');
        }

        // Use dataTransformer to transform the returned data.
        if ($result->succeeded() && $result->hasData()) {
            foreach ($result->getData() as $key => $value) {
                $response['data'][$key] = $this->dataTransformer->createData($value)->toArray();
            }
        }

        return response()->json($response);
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
