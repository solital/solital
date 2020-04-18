<?php

namespace Vinci;
use Content\Content;

class Vinci {
    
    public function Controller(string $name) {
        file_put_contents(ROOT."/App/Lua/Controllers/", Content::cController($name));
    }
    
}
