<?php

use PHPUnit\Framework\TestCase;
use Solital\Core\Kernel\Dotenv;

class DotEnvTest extends TestCase
{
    public function testAddEnv()
    {
        Dotenv::env(dirname(__DIR__, 2));
        $res = Dotenv::add('KEY_TEST', 'value');
        $this->assertTrue($res);
    }

    public function testExistsEnv()
    {
        Dotenv::env(dirname(__DIR__, 2));
        $res1 = Dotenv::isset('KEY_TEST');
        $res2 = Dotenv::isset('KEY_NOT_EXISTS_TEST');

        $this->assertTrue($res1);
        $this->assertFalse($res2);
    }

    public function testReadEnv()
    {
        Dotenv::env(dirname(__DIR__, 2));
        $this->assertEquals('value', getenv('KEY_TEST'));
    }
}