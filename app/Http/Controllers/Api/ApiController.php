<?php

namespace Stellar\Http\Controllers\Api;

use Carbon\Carbon;
use Illuminate\Http\Request;
use League\Fractal\Manager;
use Stellar\Api\Contracts\CommandHandlerInterface;
use Stellar\Api\Contracts\CommandResultInterface;
use Stellar\Exceptions\UnknownCommandException;
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
        $command   = $request->input('command');
        $arguments = $request->input('arguments', []);
        try {
            $result   = $handler->handle($player, $command, $arguments);
            $response = $this->getResponse($result);
        } catch (UnknownCommandException $e) {
            $result   = null;
            $response = $this->getErrorResponse($e->getMessage());
        }

        // Mark the response with the requestId.
        if ($request->has('requestId')) {
            $response['requestId'] = $request->input('requestId');
        }

        // Use dataTransformer to transform the returned data.
        if ($result !== null && $result->succeeded() && $result->hasData()) {
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
     * @param string $message
     *
     * @return array
     */
    protected function getErrorResponse($message)
    {
        $response = [
          'success'    => false,
          'messages'   => [$message],
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
            return $this->getErrorResponse('No result');
        }
        return $this->getBasicResponse($result);
    }
}
