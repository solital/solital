<?php

namespace Solital\Database\Forgot;

use PDO;
use Solital\Database\ORM;
use Katrina\Exception\Exception;

class Forgot
{
    /**
     * @param string $sql
     * 
     * @return bool
     */
    public function queryDatabase(string $sql)
    {
        try {
            $stmt = ORM::query($sql);
            $stmt->execute();
            $res = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($res == false) {
                return false;
            }

            return $res;
        } catch (\PDOException $e) {
            Exception::alertMessage($e, "'queryDatabase()' error");
        }
    }
}
