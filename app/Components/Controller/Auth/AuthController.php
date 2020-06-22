<?php

namespace Solital\Components\Controller\Auth;
use Solital\Security\Guardian;
use Solital\Message\Message;
use Katrina\Katrina;

class AuthController
{
    private $user_column;
    private $pass_column;
    private $user_post;
    private $pass_post;

    public function register($table) 
    {
        $user = filter_input(INPUT_POST, $this->user_post);
        $pass = filter_input(INPUT_POST, $this->pass_post);
        
        $res = Guardian::verifyLogin()
               ->table($table)
               ->fields($this->user_column, $this->pass_column, $user, $pass);
        
        if ($res) {
            Guardian::validate($user);
        } else {
            return false;
        }
    }

    public function columns($user_column, $pass_column)
    {
        $this->user_column = $user_column;
        $this->pass_column = $pass_column;

        return $this;
    }

    public function values($user_post, $pass_post)
    {
        $this->user_post = $user_post;
        $this->pass_post = $pass_post;

        return $this;
    }
}
