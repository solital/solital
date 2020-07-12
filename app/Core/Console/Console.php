<?php

namespace Solital\Core\Console;
use Solital\Core\Console\Commands;
use Solital\Database\Create\Create;

class Console extends Commands
{
    const SOLITAL_VERSION = "0.7.0";
    const VINCI_VERSION = "0.8.0";

    public static function verify($command, $file_create, $folder = null)
    {
        switch ($command) {
            case 'controller':
                $file = ucfirst($file_create);
                $return = Commands::controller($file);
            
                if ($return == true) {
                    print_r("Controller ".$file."Controller created\n\n");
                } else {
                    print_r("Error: Controller ".$file."Controller not created\n\n");
                }

                break;

            case 'model':
                $file = ucfirst($file_create);
                $return = Commands::model($file);
            
                if ($return == true) {
                    print_r("Model $file created\n\n");
                } else {
                    print_r("Error: Model $file not created\n\n");
                }

                break;

            case 'view':
                $return = Commands::view($file_create);
            
                if ($return == true) {
                    print_r("View $file_create created\n\n");
                } else {
                    print_r("Error: View $file_create not created\n\n");
                }

                break;

            case 'router':
                $return = Commands::router($file_create, $folder);
            
                if ($return == true) {
                    print_r("Router $file_create created\n\n");
                } else {
                    print_r("Error: Router $file_create not created\n\n");
                }

                break;

            case 'js':
                $return = Commands::jsFile($file_create);
            
                if ($return == true) {
                    print_r("JavaScript $file_create file created\n\n");
                } else {
                    print_r("Error: JavaScript $file_create file not created\n\n");
                }

                break;

            case 'css':
                $return = Commands::cssFile($file_create);
            
                if ($return == true) {
                    print_r("Cascading Style Sheet $file_create file created\n\n");
                } else {
                    print_r("Error: Cascading Style Sheet $file_create file not created\n\n");
                }

                break;
            
            case 'remove-controller':
                $file = ucfirst($file_create);
                $return = Commands::removeController($file);
            
                if ($return == true) {
                    print_r("Controller ".$file."Controller removed\n\n");
                } else {
                    print_r("Error: Controller $file not removed or doesn't exist\n\n");
                }
                
                break;

            case 'remove-model':
                $file = ucfirst($file_create);
                $return = Commands::removeModel($file);
            
                if ($return == true) {
                    print_r("Model $file removed\n\n");
                } else {
                    print_r("Error: Model $file not removed or doesn't exist\n\n");
                }
                
                break;

            case 'remove-view':
                $return = Commands::removeView($file_create);
            
                if ($return == true) {
                    print_r("View $file_create removed\n\n");
                } else {
                    print_r("Error: View $file_create not removed or doesn't exist\n\n");
                }
                
                break;

            case 'remove-router':
                $return = Commands::removeRouter($file_create, $folder);
            
                if ($return == true) {
                    print_r("Router $file_create removed\n\n");
                } else {
                    print_r("Error: Router $file_create not removed or doesn't exist\n\n");
                }
                
                break;

            case 'remove-js':
                $return = Commands::removeJs($file_create);
            
                if ($return == true) {
                    print_r("JavaScript $file_create file removed\n\n");
                } else {
                    print_r("Error: JavaScript $file_create file not removed or doesn't exist\n\n");
                }
                
                break;

            case 'remove-css':
                $return = Commands::removeCss($file_create);
            
                if ($return == true) {
                    print_r("Cascading Style Sheet $file_create file removed\n\n");
                } else {
                    print_r("Error: Cascading Style Sheet $file_createfile not removed or doesn't exist\n\n");
                }
                
                break;

            case 'katrina':
                if ($file_create == "configure") {
                    echo "Enter the drive, host, database name, username and password for your database separated by commas\n\n> ";
                    $stdin = fopen("php://stdin","rb");
                    $res = fgets($stdin);
                    $res = \str_replace(" ", "", $res);
                }
                
                $create = new Create();
                if (method_exists($create, $file_create)) {
                    if ($file_create == "configure") {
                        $create->configure(trim($res));
                        exit;
                    }

                    $create->$file_create();
                } else {
                    echo "\n\033[91mError:\033[0m the reported method doesn't exist\n\n";
                }
                break;
        }
    }

    public static function vinciCommand($command)
    {
        switch ($command) {
            case 'cache-clear':
                $dir = \dirname(__DIR__)."/Solital/Cache/tmp/";
                
                if(is_dir($dir)) {
                    $directory = dir($dir);
        
                    while($file = $directory->read()) {
                        if(($file != '.') && ($file != '..')) {
                            unlink($dir.$file);
                        }
                    }

                    \print_r("Cache was cleared successfully\n\n");
                
                    $directory->close();
                } else {
                    \print_r("Error clearing the cache\n\n");
                }
                break;

            case 'katrina-dump':
                Commands::dump("./");
                break;

            case 'about':
                $about = "Solital framework \033[96m ".Console::SOLITAL_VERSION."\033[0m\n\n";
                $about .= "Thank you for using Solital, you can see the full documentation at https://solital.com/documentation/starting\n\n";
                $about .= "Components Version\n";
                $about .= "+-------------------------+\n";
                $about .= "+ Katrina ORM   |\033[93m ".\Solital\Database\ORM::KATRINA_VERSION."\033[0m   +\n";
                $about .= "+-------------------------+\n";
                $about .= "+ Vinci Console |\033[93m ".Console::VINCI_VERSION."\033[0m   +\n";
                $about .= "+-------------------------+\n";
                $about .= "+ PHP Version   |\033[93m ".PHP_MAJOR_VERSION.".".PHP_MINOR_VERSION.".".PHP_RELEASE_VERSION."\033[0m  +\n";
                $about .= "+-------------------------+\n\n";
                $about .= "To access the list of Vinci commands, run the command \033[92mphp vinci show\033[0m\n\n";
                
                \print_r($about);
                break;
            
            case 'show':
                $show = "Below is a list of all vinci commands\n\n";
                $show .= "\033[33mUsage:\033[0m\n\n";
                $show .= "To create a component:\n";
                $show .= "  \033[92mphp vinci [component]:[file]\033[0m\n\n";
                $show .= "To run a command:\n";
                $show .= "  \033[92mphp vinci [command]\033[0m\n\n";
                
                $show .= "\033[33mComponents:\033[0m\n\n";
                $show .= "  \033[92mcontroller\033[0m          Create a new Controller\n";
                $show .= "  \033[92mmodel\033[0m               Create a new Model\n";
                $show .= "  \033[92mview\033[0m                Create a new View\n";
                $show .= "  \033[92mrouter\033[0m              Create a new Router\n";
                $show .= "  \033[92mjs\033[0m                  Create a new JavaScript file\n";
                $show .= "  \033[92mcss\033[0m                 Create a new Cascading Style Sheet file\n";
                $show .= "  \033[92mremove-controller\033[0m   Remove a Controller\n";
                $show .= "  \033[92mremove-model\033[0m        Remove a Model\n";
                $show .= "  \033[92mremove-view\033[0m         Remove a View\n";
                $show .= "  \033[92mremove-router\033[0m       Remove a Router\n";
                $show .= "  \033[92mremove-js\033[0m           Remove a JavaScript file\n";
                $show .= "  \033[92mremove-css\033[0m          Remove a Cascading Style Sheet file\n\n";

                $show .= "\033[33mCommands:\033[0m\n\n";
                $show .= "  \033[92mabout\033[0m           Shows version of solital and components\n";
                $show .= "  \033[92mshow\033[0m            Lists all Vinci commands\n";
                $show .= "  \033[92mcache-clear\033[0m     Clears the solital cache\n";
                $show .= "  \033[92mauth\033[0m            Create classes for login\n";
                $show .= "  \033[92mremove-auth\033[0m     Removes the components created with the \033[92mauth\033[0m command\n";
                
                \print_r($show);
                break;

            case 'auth':
                $return = Commands::authComponents();
            
                if ($return == true) {
                    print_r("Created components. Run the command \033[92mcomposer dump-autoload -o\033[0m to load the classes\n\n");
                } else {
                    print_r("Error: it wasn't possible to create the components\n\n");
                }
                break;

            case 'remove-auth':
                
                echo "Are you sure you want to delete the authentication components? (this process cannot be undone)? [Y/N]";
                $stdin = fopen("php://stdin","rb");
                $res = fgets($stdin);
                $res = strtoupper($res);

                if (\trim($res) == "Y") {
                    $return = Commands::removeAuth();
            
                    if ($return == true) {
                        print_r("Components removed\n\n");
                    } else {
                        print_r("Error: it wasn't possible to remove the components\n\n");
                    }
                } else if (\trim($res) == "N") {
                    echo "Aborted\n\n";
                    exit;
                }

                break;

            case 'forgot':
                $return = Commands::forgotComponents();
            
                if ($return == true) {
                    print_r("Created components. Run the command \033[92mcomposer dump-autoload -o\033[0m to load the classes\n\n");
                } else {
                    print_r("Error: it wasn't possible to create the components\n\n");
                }
                break;

            case 'remove-forgot':
            
                echo "Are you sure you want to delete the forgot password components? (this process cannot be undone)? [Y/N]";
                $stdin = fopen("php://stdin","rb");
                $res = fgets($stdin);
                $res = strtoupper($res);

                if (\trim($res) == "Y") {
                    $return = Commands::removeForgot();
            
                    if ($return == true) {
                        print_r("Components removed\n\n");
                    } else {
                        print_r("Error: it wasn't possible to remove the components\n\n");
                    }
                } else if (\trim($res) == "N") {
                    echo "Aborted\n\n";
                    exit;
                }

                break;
        }
    }
}
