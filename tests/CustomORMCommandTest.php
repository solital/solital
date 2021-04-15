<?php

use PHPUnit\Framework\TestCase;
use Solital\Core\Console\Command\CustomCommand;

class CustomORMCommandTest extends TestCase
{
    public function testORMConsole()
    {
        $res = (new CustomCommand())->exec('katrina-version');
        $this->assertNull($res);
    }
}
