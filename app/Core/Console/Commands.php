<?php

namespace Solital\Core\Console;

use Solital\Database\Create\Create;

class Commands
{
    protected static function removeController(string $name)
    {
        $file = ROOT_VINCI."/app/Components/Controller/".$name.".php";

        if (is_file($file)) {
            unlink($file);
        
            return true;
        }
        
        return false;
    }

    protected static function removeModel(string $name)
    {
        $file = ROOT_VINCI."/app/Components/Model/".$name.".php";

        if (is_file($file)) {
            unlink($file);
        
            return true;
        }
        
        return false;   
    }

    protected static function removeView(string $name)
    {
        $file = "./resources/view/".$name.".php";

        if (is_file($file)) {
            unlink($file);
        
            return true;
        }
        
        return false;   
    }

    protected static function removeRouter(string $name, string $folder = null)
    {
        $file = "./routers/".$name.".php";
        
        if (isset($folder)) {
            $file = "./routers".$folder."/".$name.".php";
        }

        if (is_file($file)) {
            unlink($file);
        
            return true;
        }
        
        return false;   
    }

    protected static function removeJs(string $name)
    {
        $file = "./public/assets/_js/".$name.".js";

        if (is_file($file)) {
            unlink($file);
        
            return true;
        }
        
        return false;   
    }

    protected static function removeCss(string $name)
    {
        $file = "./public/assets/_css/".$name.".css";

        if (is_file($file)) {
            unlink($file);
        
            return true;
        }
        
        return false;   
    }

    protected static function router(string $name, string $folder = null) 
    {
        $dir = "./routers/";

        if (isset($folder)) {
            \mkdir("./routers".$folder);
            $dir = "./routers".$folder."/";
        }

        if (is_dir($dir)) {
            file_put_contents($dir."$name.php", "<?php\n\nuse Solital\Course\Course;\nuse Solital\Wolf\Wolf;\n\nCourse::get('/', function(){\n\n});");
            
            return true;
        }
        
        return false;
    }
    
    protected static function controller(string $name) 
    {
        $dir = ROOT_VINCI."/app/Components/Controller/";
        
        if (is_dir($dir)) {
            file_put_contents($dir."$name.php", "<?php\n\nnamespace Solital\Components\Controller;\n\nclass ".$name."\n{\n\n}");
            
            return true;
        }
        
        return false;
    }
    
    protected static function view(string $name) 
    {
        $dir = "./resources/view/";
        if (is_dir($dir)) {
            file_put_contents($dir."$name.php", "<h1>$name</h1>");
            
            return true;
        }
        
        return false;
    }
    
    protected static function model(string $name) 
    {
        $dir = ROOT_VINCI."/app/Components/Model/";
        
        if (is_dir($dir)) {
            file_put_contents($dir."$name.php", "<?php\n\nnamespace Solital\Components\Model;\nuse Solital\Components\Model\Model;\n\nclass ".$name." extends Model\n{\n\n}");
            
            return true;
        }
        
        return false;
    }
    
    protected static function jsFile(string $name) 
    {
        $dir = "./public/assets/_js/";
        
        if (is_dir($dir)) {
            file_put_contents($dir."$name.js", "");
            
            return true;
        }
        
        return false;
    }

    protected static function cssFile(string $name) 
    {
        $dir = "./public/assets/_css/";
        
        if (is_dir($dir)) {
            file_put_contents($dir."$name.css", "");
            
            return true;
        }
        
        return false;
    }

    protected static function dump(string $local) 
    {
        $command = exec("mysqldump -u ".DB_CONFIG['USER']." -p".DB_CONFIG['PASS']." ".DB_CONFIG['DBNAME']." > ".$local."/".DB_CONFIG['DBNAME'].".sql");
        
        if ($command) {
            echo 'dump';
            return true;
        } else {
            echo 'erro';
            return false;
        }
    }

    public function authComponents()
    {
        $controller = "<?php\n\n";
        $controller .= "namespace Solital\Components\Controller;\n";
        $controller .= "use Solital\Components\Controller\Auth\AuthController;\n";
        $controller .= "use Solital\Core\Wolf\Wolf;\n\n";
        $controller .= "class LoginController extends AuthController\n{\n";
        $controller .= "\x20\x20\x20\x20public function login()\n";
        $controller .= "\x20\x20\x20\x20{\n";
        $controller .= "\x20\x20\x20\x20\x20\x20\x20\x20Wolf::loadView('auth/login');\n";
        $controller .= "\x20\x20\x20\x20}";
        $controller .= "\n\n";
        $controller .= "\x20\x20\x20\x20public function checkLogin2()\n";
        $controller .= "\x20\x20\x20\x20{\n";
        $controller .= "\x20\x20\x20\x20\x20\x20\x20\x20\x24res = \x24this->columns('email_column', 'pass_column')\n";
        $controller .= "\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20->values('email_input_value', 'pass_input_value')\n";
        $controller .= "\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20->register('your_table');\n\n";
        $controller .= "\x20\x20\x20\x20\x20\x20\x20\x20if (\x24res == false) {\n";
        $controller .= "\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20response()->redirect('/url_login');\n";
        $controller .= "\x20\x20\x20\x20\x20\x20\x20\x20}\n";
        $controller .= "\x20\x20\x20\x20}";
        $controller .= "\n\n";
        $controller .= "\x20\x20\x20\x20public function dashboard()\n";
        $controller .= "\x20\x20\x20\x20{\n";
        $controller .= "\x20\x20\x20\x20\x20\x20\x20\x20Wolf::loadView('auth/dashboard');\n";
        $controller .= "\x20\x20\x20\x20}";
        $controller .= "\n\n";
        $controller .= "\x20\x20\x20\x20public function exit()\n";
        $controller .= "\x20\x20\x20\x20{\n";
        $controller .= "\x20\x20\x20\x20\x20\x20\x20\x20Guardian::logoff();\n";
        $controller .= "\x20\x20\x20\x20}";
        $controller .= "\n\n";
        $controller .= "}";

        $controller_pass = "<?php\n\n";
        $controller_pass .= "namespace Solital\Components\Controller;\n";
        $controller_pass .= "use Solital\Components\Controller\Auth\AuthController;\n\n";
        $controller_pass .= "class ChangeController extends AuthController\n{\n";
        $controller_pass .= "\x20\x20\x20\x20public function newEmail()\n";
        $controller_pass .= "\x20\x20\x20\x20{\n";
        $controller_pass .= "\x20\x20\x20\x20\x20\x20\x20\x20\x24old_email = input()->post('old_email');\n";
        $controller_pass .= "\x20\x20\x20\x20\x20\x20\x20\x20\x24new_email = input()->post('new_email');\n\n";
        $controller_pass .= "\x20\x20\x20\x20\x20\x20\x20\x20Guardian::changeEmail('tb_admin', 'emailAdm', \x24email, \x24new_email);\n\n";
        $controller_pass .= "\x20\x20\x20\x20\x20\x20\x20\x20response()->redirect('/url_dashboard');\n";
        $controller_pass .= "\x20\x20\x20\x20}";
        $controller_pass .= "\n\n";
        $controller_pass .= "}";

        $view_login = "<form action='<?= url('verifyLogin'); ?>' method='post'>\n";
        $view_login .= "\x20\x20\x20\x20<input type='text' name='email' placeholder='E-mail'><br>\n";
        $view_login .= "\x20\x20\x20\x20<input type='password' name='pass' placeholder='Senha'><br>\n";
        $view_login .= "\x20\x20\x20\x20<button type='submit'>Acessar</button>\n";
        $view_login .= "</form>";
        
        $view_dashboard = "<h1>Dashboard</h1>\n\n";
        $view_dashboard .= "<a href='<?= url('exit'); ?>'>Sair</a>";

        $view_pass = "<form action='<?= url('verifyLogin'); ?>' method='post'>\n";
        $view_pass .= "\x20\x20\x20\x20<input type='text' name='old_email' placeholder='Old email'><br>\n";
        $view_pass .= "\x20\x20\x20\x20<input type='password' name='new_email' placeholder='New email'><br>\n";
        $view_pass .= "\x20\x20\x20\x20<button type='submit'>Alterar</button>\n";
        $view_pass .= "</form>";

        $dir_controller = ROOT_VINCI."/app/Components/Controller/Auth/";
        
        if (is_dir($dir_controller)) {
            file_put_contents($dir_controller."LoginController.php", $controller);
            file_put_contents($dir_controller."ChangeController.php", $controller_pass);
        }

        $dir_view = "./resources/auth/";

        if (!is_dir($dir_view)) {
            mkdir($dir_view);
        }
        
        if (is_dir($dir_view)) {
            file_put_contents($dir_view."login.php", $view_login);
            file_put_contents($dir_view."dashboard.php", $view_dashboard);
        }

        $new_routes = "\n\nCourse::get('/login', '\Solital\Components\Controller\LoginController@login');\n";
        $new_routes .= "Course::post('/verificar', '\Solital\Components\Controller\LoginController@verify')->name('verifyLogin');\n";
        $new_routes .= "Course::get('/dashboard', '\Solital\Components\Controller\LoginController@dashboard');\n";
        $new_routes .= "Course::get('/logoff', '\Solital\Components\Controller\LoginController@exit')->name('exit');\n";

        $routes = fopen("./routers/routes.php", "a+");
        fwrite($routes, $new_routes);
        fclose($routes);

        $create = new Create();
        $create->userAuth();

        \exec("composer dump-autoload -o", $output);
        \exec("php composer.phar dump-autoload -o", $output);
        
        return true;
    }

    public function removeAuth()
    {
        $file_login = ROOT_VINCI."/app/Components/Controller/Auth/LoginController.php";
        $file_change = ROOT_VINCI."/app/Components/Controller/Auth/ChangeController.php";
        $file_login_view = ROOT_VINCI."/resources/auth/login.php";
        $file_dashboard_view = ROOT_VINCI."/resources/auth/dashboard.php";
        $folder_view = ROOT_VINCI."/resources/auth";

        if (is_file($file_login) && is_file($file_change) && is_file($file_login_view) && is_file($file_dashboard_view)) {
            unlink($file_login);
            unlink($file_change);
            unlink($file_login_view);
            unlink($file_dashboard_view);
            rmdir($folder_view);

            return true;
        }

        return false;
    }
}
