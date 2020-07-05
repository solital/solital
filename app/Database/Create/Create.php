<?php

namespace Solital\Database\Create;
use Solital\Database\ORM;
use Solital\Database\Create\SQLCommands;

class Create extends SQLCommands
{
    /**
     * Data when creating a standard user
     */
    public function __construct()
    {
        include ROOT_VINCI.'/config/db.php';
        $this->table = "tb_auth";
        $this->primaryKey = "id_user";
        $this->columns = [
            "username",
            "pass"
        ];
        
        if (!defined('DB_CONFIG')) {
            echo "\n\033[91mError:\033[0m The database doesn't' exist or wasn't reported in the \033[34mdb.php\033[0m file\n\n";
            exit;
        }
    }

    /**
     * Configure the db.php file
     * @param string $value
     */
    public function configure($value)
    {
        $value = explode(",", $value);
        $res = count($value);
        
        if ($res != 5) {
            echo "\n\n\033[91mError: there are missing values\033[0m\n";
            echo "Enter the drive, host, database name, username and password for your database separated by commas\n\n ";
            exit;
        }

        $db = "<?php\n\n";
        $db .= "define('DB_CONFIG', [\n";
        $db .= "\x20\x20\x20\x20'DRIVE' => '".$value[0]."',\n";
        $db .= "\x20\x20\x20\x20'HOST' => '".$value[1]."',\n";
        $db .= "\x20\x20\x20\x20'DBNAME' => '".$value[2]."',\n";
        $db .= "\x20\x20\x20\x20'USER' => '".$value[3]."',\n";
        $db .= "\x20\x20\x20\x20'PASS' => '".$value[4]."'\n";
        $db .= "]);";

        file_put_contents(ROOT_VINCI."/config/db.php", $db);

        echo "\n\n\033[34mdb.php\033[0m file successfully configured\n\n";
    }

    /**
     * Creates a standard user in the database
     */
    public function userAuth()
    {
        $res = $this->instance()
                    ->createTable("tb_auth")
                    ->int("id_user")->primary()->increment()
                    ->varchar("username", 50)->notNull()
                    ->varchar("pass", 150)->notNull()
                    ->closeTable()
                    ->build();

        if ($res == true) {
            ## pass = solital
            $res = $this->instance()->insert(['solital@email.com', '$2y$10$caZsHBy5/uPkCREwLCSlmOzQHIcCWlYre1IQuX3cxY/zRPyROEflC']);
            
            if ($res == true) {
                echo "Table and user created successfully\n\n";
            }

        } else {
            echo "\n\033[91mError:\033[0m table not created\n\n";
        }
    }
}
