<?php

namespace Solital;

use Solital\Core\Console\Command\CustomCommand;
use Solital\Core\Console\Command\CustomConsoleInterface;

/**
 * Create new commands with this class. 
 * 
 * Read the documentation at https://solitalframework/ 
 * to use the CustomConsole class
 */

class CustomConsole extends CustomCommand implements CustomConsoleInterface
{
    /**
     * @return array
     */
    public function execute(): array
    {
        return [
            'cmd-example' => 'tableExample'
        ];
    }

    /**
     * @return CustomConsole
     */
    public function tableExample(): CustomConsole
    {
        echo "This command is just a custom command test on the Vinci Console!\n";

        return $this;
    }
}
