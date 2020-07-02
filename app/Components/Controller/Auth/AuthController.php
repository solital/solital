<?php

namespace Solital\Components\Controller\Auth;
use Solital\Security\Guardian;
use Solital\Message\Message;
use Katrina\Katrina;

class AuthController
{
    /**
     * @var string
     */
    private $user_column;

    /**
     * @var string
     */
    private $pass_column;

    /**
     * @var string
     */
    private $user_post;

    /**
     * @var string
     */
    private $pass_post;

    /**
     * Authenticates the user in the system
     * @param string $table
     */
    public function register(string $table) 
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

    /**
     * Database columns
     * @param string $user_column
     * @param string $pass_column
     */
    public function columns($user_column, $pass_column): self
    {
        $this->user_column = $user_column;
        $this->pass_column = $pass_column;

        return $this;
    }

    /**
     * HTML input values
     * @param string $user_post
     * @param string $pass_post
     */
    public function values($user_post, $pass_post): self
    {
        $this->user_post = $user_post;
        $this->pass_post = $pass_post;

        return $this;
    }
}
