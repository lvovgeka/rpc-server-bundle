<?php

namespace Timiki\Bundle\RpcServerBundle\Exceptions;

class MethodNotFoundException extends ErrorException
{
    /**
     * MethodNotFoundException constructor.
     *
     * @param null $data
     * @param null $id
     */
    public function __construct($data = null, $id = null)
    {
        parent::__construct('Method not found', -32601, $data, $id);
    }
}

