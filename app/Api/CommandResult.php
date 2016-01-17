<?php

namespace Stellar\Api;

use League\Fractal\Resource\ResourceInterface;

class CommandResult implements \Stellar\Contracts\CommandResult
{

    const STATUS_ERROR = false;
    const STATUS_OK = true;

    /**
     * @var bool
     */
    protected $status;

    /**
     * @var array
     */
    protected $data;

    /**
     * @var array
     */
    protected $messages;


    /**
     * CommandResult constructor.
     */
    public function __construct() {
        $this->status = self::STATUS_OK;
    }


    /**
     * @return bool
     */
    public function succeeded() {
        return $this->status == self::STATUS_OK;
    }


    /**
     * @return bool
     */
    public function failed() {
        return $this->status == self::STATUS_ERROR;
    }


    /**
     * Mark the result as a failure.
     *
     * @param $message
     *
     * @return \Stellar\Contracts\CommandResult
     */
    public function fail($message) {
        $this->addMessage($message);
        $this->status = self::STATUS_ERROR;

        return $this;
    }


    /**
     * @return array
     */
    public function getData() {
        return $this->data;
    }


    /**
     * @return bool
     */
    public function hasData() {
        return ! empty($this->data);
    }


    /**
     * @param string            $key
     * @param ResourceInterface $item
     *
     * @return \Stellar\Contracts\CommandResult
     */
    public function addItem($key, $item) {
        $this->data[$key] = $item;

        return $this;
    }


    /**
     * @return array
     */
    public function getMessages() {
        return $this->messages;
    }


    /**
     * @param string $message
     *
     * @return \Stellar\Contracts\CommandResult
     */
    public function addMessage($message) {
        $this->messages[] = $message;

        return $this;
    }

}
