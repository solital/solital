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
        }

        $dir_view = "./resources/auth/";

        if (!is_dir($dir_view)) {
            mkdir($dir_view);
        }
        
        if (is_dir($dir_view)) {
            file_put_contents($dir_view."login.php", $view_login);
            file_put_contents($dir_view."dashboard.php", $view_dashboard);
        }

        $new_routes = "\nCourse::get('/login', '\Solital\Components\Controller\LoginController@login');\n";
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

        if (is_file($file_login) && is_file($file_change) && is_file($file_login_view) && is_file($file_dashboard_view)) {
            unlink($file_login);
            unlink($file_change);
            unlink($file_login_view);
            unlink($file_dashboard_view);

            return true;
        }

        return false;
    }

    public function forgotComponents()
    {
        $controller = "<?php\n\n";
        $controller .= "namespace Solital\Components\Controller\Auth;\n";
        $controller .= "use Solital\Core\Wolf\Wolf;\n";
        $controller .= "use Solital\Core\Security\Hash;\n";
        $controller .= "use Solital\Core\Security\Reset;\n\n";
        $controller .= "class ForgotController\n{\n";
        $controller .= "\x20\x20\x20\x20public function forgot()\n";
        $controller .= "\x20\x20\x20\x20{\n";
        $controller .= "\x20\x20\x20\x20\x20\x20\x20\x20Wolf::loadView('auth/forgot');\n";
        $controller .= "\x20\x20\x20\x20}";
        $controller .= "\n\n";
        $controller .= "\x20\x20\x20\x20public function change(\x24hash)\n";
        $controller .= "\x20\x20\x20\x20{\n";
        $controller .= "\x20\x20\x20\x20\x20\x20\x20\x20\x24res = Hash::decrypt(\x24hash)::isValid();\n\n";
        $controller .= "\x20\x20\x20\x20\x20\x20\x20\x20if (\x24res == true) {\n";
        $controller .= "\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20Wolf::loadView('change', [\n";
        $controller .= "\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20'hash' => \x24hash\n";
        $controller .= "\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20]);\n\n";
        $controller .= "\x20\x20\x20\x20\x20\x20\x20\x20} else {\n";
        $controller .= "\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20response()->redirect('/your_url_to_redirect');\n";
        $controller .= "\x20\x20\x20\x20\x20\x20\x20\x20}\n";
        $controller .= "\x20\x20\x20\x20}";
        $controller .= "\n\n";
        $controller .= "\x20\x20\x20\x20public function forgotPost()\n";
        $controller .= "\x20\x20\x20\x20{\n";
        $controller .= "\x20\x20\x20\x20\x20\x20\x20\x20\x24email = input()->post('email')->getValue();\n\n";
        $controller .= "\x20\x20\x20\x20\x20\x20\x20\x20\x24res = (new Reset())->table('tb_admin', 'emailAdm')->forgotPass(\x24email, '/change');\n\n";
        $controller .= "\x20\x20\x20\x20\x20\x20\x20\x20\x24response()->redirect('/your_url_to_redirect');\n";
        $controller .= "\x20\x20\x20\x20}";
        $controller .= "\n\n";
        $controller .= "\x20\x20\x20\x20public function changePost()\n";
        $controller .= "\x20\x20\x20\x20{\n";
        $controller .= "\x20\x20\x20\x20\x20\x20\x20\x20\x24pass = input()->post('pass')->getValue();\n";
        $controller .= "\x20\x20\x20\x20\x20\x20\x20\x20\x24confPass = input()->post('confPass')->getValue();\n\n";
        $controller .= "\x20\x20\x20\x20\x20\x20\x20\x20if (\x24res == true) {\n";
        $controller .= "\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20Wolf::loadView('change', [\n";
        $controller .= "\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20'hash' => \x24hash\n";
        $controller .= "\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20]);\n\n";
        $controller .= "\x20\x20\x20\x20\x20\x20\x20\x20} else {\n";
        $controller .= "\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20\x20response()->redirect('/your_url_to_redirect');\n";
        $controller .= "\x20\x20\x20\x20\x20\x20\x20\x20}\n";
        $controller .= "\x20\x20\x20\x20}";
        $controller .= "\n\n";
        $controller .= "}";

        $view_forgot = "<h1>Forgot password</h1>\n\n";
        $view_forgot .= "<form action='<?= url('forgot'); ?>' method='post'>\n";
        $view_forgot .= "\x20\x20\x20\x20<input type='email' name='email' placeholder='Your e-mail'><br>\n";
        $view_forgot .= "\x20\x20\x20\x20<button type='submit'>Submit</button>\n";
        $view_forgot .= "</form>";

        $view_change = "<h1>Change password</h1>\n\n";
        $view_change .= "<form action='<?= url('forgot'); ?>' method='post'>\n";
        $view_change .= "\x20\x20\x20<input type='password' name='pass' placeholder='New password'><br><br>\n";
        $view_change .= "\x20\x20\x20<input type='password' name='confPass' placeholder='repeat new password'><br><br>\n";
        $view_change .= "\x20\x20\x20\x20<button type='submit'>Change</button>\n";
        $view_change .= "</form>";

        $dir_controller = ROOT_VINCI."/app/Components/Controller/Auth/";
        
        if (is_dir($dir_controller)) {
            file_put_contents($dir_controller."ForgotController.php", $controller);
        }

        $dir_view = "./resources/auth/";

        if (!is_dir($dir_view)) {
            mkdir($dir_view);
        }
        
        if (is_dir($dir_view)) {
            file_put_contents($dir_view."forgot.php", $view_forgot);
            file_put_contents($dir_view."change.php", $view_change);
        }

        $new_routes = "\nCourse::get('/forgot', 'Auth\ForgotController@forgot')->name('forgot');\n";
        $new_routes .= "Course::post('/forgotPost', 'Auth\ForgotController@forgotPost')->name('forgotPost');\n";
        $new_routes .= "Course::get('/change', 'Auth\ForgotController@change')->name('change');\n";
        $new_routes .= "Course::get('/changePost', 'Auth\ForgotController@changePost')->name('changePost');\n";

        $routes = fopen("./routers/routes.php", "a+");
        fwrite($routes, $new_routes);
        fclose($routes);

        return true;
    }

    public function removeForgot()
    {
        $file_forgot = ROOT_VINCI."/app/Components/Controller/Auth/ForgotController.php";
        $file_forgot_view = ROOT_VINCI."/resources/auth/forgot.php";
        $file_change_view = ROOT_VINCI."/resources/auth/change.php";

        if (is_file($file_forgot) && is_file($file_forgot_view) && is_file($file_change_view)) {
            unlink($file_forgot);
            unlink($file_forgot_view);
            unlink($file_change_view);

            return true;
        }

        return false;
    }
}
