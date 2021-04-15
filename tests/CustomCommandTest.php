<?php

use PHPUnit\Framework\TestCase;
use Solital\Core\Console\Command\CustomCommand;

class CustomCommandTest extends TestCase
{
    public function testCustom()
    {
        $res = (new CustomCommand())->exec('cmd-example');
        $this->assertNull($res);
    }
}
