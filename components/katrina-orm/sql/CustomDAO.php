<?php

namespace Component\Katrina;
use Component\Katrina\DB as DB;
use Component\Katrina\Exception;
use PDO;

abstract class CustomDAO
{
    public function customQueryAll(string $query)
    {
        try {
            $stmt = DB::query($query);
            $stmt->execute();
            $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
            return $res;
        } catch (\PDOException $e) {
            Exception::alertMessage($e, "'customQueryAll()' error");
            die();
        }
    }

    public function customQueryOnly(string $query)
    {
        try {
            $stmt = DB::query($query);
            $stmt->execute();
            $res = $stmt->fetch(PDO::FETCH_ASSOC);
        
            return $res;
        } catch (\PDOException $e) {
            Exception::alertMessage($e, "'customQueryOnly()' error");
            die();
        }
    }
}
