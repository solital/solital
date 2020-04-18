<?php

namespace Solital\Controllers;
use Wolf\Wolf;

class DevModeController 
{
    public function index() {
        Wolf::loadView('dev-mode/dev-mode', [], false);
    }
}
