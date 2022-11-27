<?php

namespace App\Exceptions;

use Exception;

class BusinessException extends Exception
{
    private $error;
    private $data;

    public function __construct(string $error, string $message = 'Error!', $data = null)
    {
        parent::__construct($message);
        $this->error = $error;
        $this->data = $data;
    }

    /**
     * @return mixed
     */
    public function getError()
    {
        return $this->error;
    }

    public function getData()
    {
        return $this->data;
    }
}
