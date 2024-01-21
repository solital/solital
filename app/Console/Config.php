<?php

namespace Solital\Console;

use Solital\Core\Console\Interface\ExtendCommandsInterface;
use Solital\Core\Kernel\Application;

/**
 * DON'T REMOVE THIS FILE
 */
class Config implements ExtendCommandsInterface
{
    /**
     * @var array
     */
    protected array $command_class = [];

    /**
     * @return array
     */
    public function getCommandClass(): array
    {
        $this->command_class = Application::getUserCommands();
        return $this->command_class;
    }

    /**
     * @return string
     */
    public function getTypeCommands(): string
    {
        return "User Command";
    }
}
