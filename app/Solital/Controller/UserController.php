<?php

namespace Solital\Controller;
use Component\Katrina\Katrina as Katrina;
use Wolf\Wolf;
use Solital\Guardian\Guardian;
use Solital\Message\Message;
use Solital\Session\Session;
use Solital\Cookie\Cookie;

class UserController {

    private $table = 'tb_admin';
    private $primaryKey = 'idAdm';
    /*private $columns = [
        'idcategory', 
        'titulo',
        'resumo',
        'autor',
        'imagem',
        'nome_imagem',
        'conteudo',
        'data_not'
    ];*/
    private $columns = [
        'nomeAdm',
        'emailAdm',
        'senhaAdm',
        'contatoAdm',
        'acesso'
    ];
    
    public function instance()
    {
        $katrina = new Katrina($this->table, $this->primaryKey, $this->columns);
        return $katrina;
    }
    
    public function home() 
    {
        #$res = $this->instance()->previous();
        Guardian::checkLogin();
        $html = $this->instance()->pagination("tb_blog", 2, "Primeiro item", "Último item");
        /*echo '<pre>';
        var_dump($html);
        echo '</pre>';*/
        #Session::new('sessao', 'valor da sessão');
        #Session::show('sessao');
        #Session::delete('sessao');
        #Cookie::new('cookie_teste', 'valor cookie');
        #Cookie::show('cookie_teste');
        #Cookie::delete('cookie_teste');
        Wolf::loadView('home', [
            "title" => "about",
            "colunas" => $html['rows'],
            "setas" => $html['arrows']
        ]);
    }
    
    public function login() 
    {
        $msg = Message::getMessage('loginErrado');
        Message::clearMessage('loginErrado');
        
        Guardian::checkLogged();
        Wolf::loadView('login', [
            "title" => "Login",
            "msg" => $msg
        ]);
    }
    
    public function logoff() 
    {
        Guardian::logoff();
    }
    
    public function verificar() {
        $email = filter_input(INPUT_POST, 'email');
        $senha = filter_input(INPUT_POST, 'senha');
        $res = $this->instance()
                    ->verifyLogin('emailAdm', 'senhaAdm', $email, $senha);
        
        if ($res) {
            Guardian::validade($res['nomeAdm']);
        } else {
            Message::newMessage('loginErrado', 'E-mail e/ou senha incorretos');
            response()->redirect('login');
        }
    }

}
