<?php

namespace Solital\Vinci;
use Solital\Vinci\Components;

class Vinci extends Components
{
    const SOLITAL_VERSION = "0.3.3";
    const VINCI_VERSION = "0.3.2";

    public static function verify($command, $file_create)
    {
        switch ($command) {
            case 'controller':
                $file = ucfirst($file_create);
                $file_complete = $file.'Controller';
                $return = Components::controller($file_complete);
            
                if ($return == true) {
                    print_r("Controller created\n\n");
                } else {
                    print_r("Error: Controller not created\n\n");
                }

                break;

            case 'model':
                $file = ucfirst($file_create);
                $file_complete = $file.'Model';
                $return = Components::model($file_complete);
            
                if ($return == true) {
                    print_r("Model created\n\n");
                } else {
                    print_r("Error: Model not created\n\n");
                }

                break;

            case 'view':
                $return = Components::view($file_create);
            
                if ($return == true) {
                    print_r("View created\n\n");
                } else {
                    print_r("Error: View not created\n\n");
                }

                break;

            case 'router':
                $return = Components::router($file_create);
            
                if ($return == true) {
                    print_r("Router created\n\n");
                } else {
                    print_r("Error: Router not created\n\n");
                }

                break;

            case 'js':
                $return = Components::jsFile($file_create);
            
                if ($return == true) {
                    print_r("JavaScript file created\n\n");
                } else {
                    print_r("Error: JavaScript file not created\n\n");
                }

                break;

            case 'css':
                $return = Components::cssFile($file_create);
            
                if ($return == true) {
                    print_r("Cascading Style Sheet file created\n\n");
                } else {
                    print_r("Error: Cascading Style Sheet file not created\n\n");
                }

                break;
            
            case 'remove-controller':
                $file = ucfirst($file_create);
                $file_complete = $file.'Controller';
                $return = Components::removeController($file_complete);
            
                if ($return == true) {
                    print_r("Controller removed\n\n");
                } else {
                    print_r("Error: Controller not removed or doesn't exist\n\n");
                }
                
                break;

            case 'remove-model':
                $file = ucfirst($file_create);
                $file_complete = $file.'Model';
                $return = Components::removeModel($file_complete);
            
                if ($return == true) {
                    print_r("Model removed\n\n");
                } else {
                    print_r("Error: Model not removed or doesn't exist\n\n");
                }
                
                break;

            case 'remove-view':
                $return = Components::removeView($file_create);
            
                if ($return == true) {
                    print_r("View removed\n\n");
                } else {
                    print_r("Error: View not removed or doesn't exist\n\n");
                }
                
                break;

            case 'remove-router':
                $return = Components::removeRouter($file_create);
            
                if ($return == true) {
                    print_r("Router removed\n\n");
                } else {
                    print_r("Error: Router not removed or doesn't exist\n\n");
                }
                
                break;

            case 'remove-js':
                $return = Components::removeJs($file_create);
            
                if ($return == true) {
                    print_r("JavaScript file removed\n\n");
                } else {
                    print_r("Error: JavaScript file not removed or doesn't exist\n\n");
                }
                
                break;

            case 'remove-css':
                $return = Components::removeCss($file_create);
            
                if ($return == true) {
                    print_r("Cascading Style Sheet file removed\n\n");
                } else {
                    print_r("Error: Cascading Style Sheet file not removed or doesn't exist\n\n");
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
                            \print_r("Cache was cleared successfully\n\n");
                        }
                    }
                
                    $directory->close();
                } else {
                    \print_r("Error clearing the cache\n\n");
                }
                break;

            case 'katrina-dump':
                Components::dump("./");
                break;

            case 'about':
                $about = "Solital framework \033[96m ".Vinci::SOLITAL_VERSION."\033[0m\n\n";
                $about .= "Thank you for using Solital, you can see the full documentation at https://solital.com/documentation/starting\n\n";
                $about .= "Components Version\n";
                $about .= "+------------------------+\n";
                $about .= "+ Katrina ORM   |\033[93m ".\Katrina\Version::KATRINA_VERSION."\033[0m  +\n";
                $about .= "+------------------------+\n";
                $about .= "+ Vinci Console |\033[93m ".Vinci::VINCI_VERSION."\033[0m  +\n";
                $about .= "+------------------------+\n\n";
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
                
                \print_r($show);
                break;
        }
    }
}
