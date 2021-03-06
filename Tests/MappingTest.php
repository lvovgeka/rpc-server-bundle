<?php

namespace Timiki\Bundle\RpcServerBundle\Tests;

use PHPUnit\Framework\TestCase;

class MappingTest extends TestCase
{
    public function testMapping()
    {
        try {
            $mapper = Utils::getMapper(__DIR__.DIRECTORY_SEPARATOR.'Method');
            self::assertCount(6, $mapper->loadMetadata()['methods']);
        } catch (\Exception $e) {
            self::fail($e->getMessage());
        }
    }

    public function testNotSetExecuteMethod()
    {
        $mapper = Utils::getMapper();

        try {
            $mapper->loadFileMetadata(__DIR__.DIRECTORY_SEPARATOR.'InvalidMethod'.DIRECTORY_SEPARATOR.'NoExecuteMethod.php');
            self::fail('Need exception');
        } catch (\Exception $e) {
            self::assertTrue(true);
        }
    }

    public function testNoRpcClass()
    {
        $mapper = Utils::getMapper();
        $result = $mapper->loadFileMetadata(__DIR__.DIRECTORY_SEPARATOR.'InvalidMethod'.DIRECTORY_SEPARATOR.'NoRpcClass.php');

        self::assertEmpty($result);
    }

}
