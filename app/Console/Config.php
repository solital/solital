<?php

namespace Solital\Console;

use Solital\Core\Console\Interface\ExtendCommandsInterface;

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
        return $this->command_class;
    }

    public function getTypeCommands(): string
    {
        return "";
    }
}