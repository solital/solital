<?php

namespace Solital\Controllers;
use Component\Katrina\Katrina as Katrina;
use Wolf\Wolf;
use Solital\Guardian\Guardian;

class UserController {

    private $table = 'usuarios';
    private $primaryKey = 'idUsu';
    private $columns = [
        'nome', 
        'idade'
    ];
    
    public function instance()
    {
        $katrina = new Katrina($this->table, $this->primaryKey, $this->columns);
        return $katrina;
    }

    public function index() 
    {   
        $res = $this->instance()->listAll();
        Guardian::send(true);
        Wolf::loadView('home', [
            "title" => "home",
            "banco" => $res, 
            "nome" => 'valor_teste'
        ]);
    }
    
    public function about() 
    {
        Wolf::loadView('about', [
            "title" => "about"
        ]);
    }
    
    public function contact() 
    {
        Wolf::loadView('contact', [
            "title" => "Contact"
        ]);
    }

}
