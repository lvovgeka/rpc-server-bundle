<?php

namespace Timiki\Bundle\RpcServerBundle\Tests\Method;

use Timiki\Bundle\RpcServerBundle\Mapping as Rpc;

/**
 * @Rpc\Method("update")
 */
class Update
{
    /**
     * @Rpc\Execute()
     */
    public function execute()
    {
        // Notification
    }
}
