<?php

namespace Component\Katrina;
use Component\Katrina\DB as DB;
use Component\Katrina\CustomDAO as CustomDAO;
use Component\Katrina\Exception;
use PDO;

abstract class DAO extends CustomDAO
{

    public function verifyLogin(string $column_email, string $column_pass, string $email, string $password)
    {
        try {
            $sql = "SELECT * FROM $this->table WHERE $column_email = '$email'";
            $stmt = DB::prepare($sql);
            $stmt->execute();
            $res = $stmt->fetch(PDO::FETCH_ASSOC);

            if (password_verify($password, $res[$column_pass])) {
                return $res;
            } else {
                return false;
            }
        } catch (\PDOException $e) {
            Exception::alertMessage($e, "'verifyLogin()' error");
        }
    }

    public function listAll(string $columns = "*", string $where = null)
    {
        try {
            $sql = "SELECT $columns FROM $this->table ";
            if (isset($where)) {
                $sql .= "WHERE ". $where;
            }
            $stmt = DB::query($sql);
            $stmt->execute();
            $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            return $res;
        } catch (\PDOException $e) {
            Exception::alertMessage($e, "'listAll()' error");
        }
    }

    public function listOnlyId(string $columns = "*", int $primarykey, string $where = null)
    {
        try {
            $sql = "SELECT $columns FROM $this->table WHERE $this->columnPrimaryKey = $primarykey ";
            if (isset($where)) {
                $sql .= "AND ". $where;
            }
            $stmt = DB::query($sql);
            $stmt->execute();
            $res = $stmt->fetch(PDO::FETCH_ASSOC);
        
            if ($res == false) {
                Exception::alertWarning("listOnlyId(): The given 'id' does not exist in the table '".$this->table."'");
            } else {
                return $res;
            }
        } catch (\PDOException $e) {
            Exception::alertMessage($e, "'listOnlyId()' error");
        }
    }

    public function innerJoin(string $columns = "*", string $columnForeign, string $columnForeignKey)
    {
        try {
            $sql = "SELECT $columns FROM $this->table a INNER JOIN $columnForeign b
            ON a.$this->columnPrimaryKey=b.$columnForeignKey";

            $stmt = DB::query($sql);
            $stmt->execute();
            $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
            if ($res == false) {
                Exception::alertWarning("innerJoin(): The given 'id' does not exist in the table '".$this->table."'");
            } else {
                return $res;
            }
        } catch (\PDOException $e) {
            Exception::alertMessage($e, "'innerJoin()' error");
        }
    }

    public function innerJoinId(string $columns = "*", string $columnForeign, string $columnForeignKey, int $primarykey)
    {
        try {
            $sql = "SELECT $columns FROM $this->table a INNER JOIN $columnForeign b
            ON a.$this->columnPrimaryKey=b.$columnForeignKey
            WHERE a.$this->columnPrimaryKey = $primarykey";

            $stmt = DB::query($sql);
            $stmt->execute();
            $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
            if ($res == false) {
                Exception::alertWarning("innerJoinId(): The given 'id' does not exist in the table '".$this->table."'");
            } else {
                return $res;
            }
        } catch (\PDOException $e) {
            Exception::alertMessage($e, "'innerJoinId()' error");
        }
    }

    public function insert(array $values = [])
    {

        $countColumns = count($this->columns);
        $resColumns = implode($this->columns, ',');

        try {
            $sql = "INSERT INTO $this->table ($resColumns) VALUES ('". implode("','", $values) ."')";
            
            $stmt = DB::prepare($sql);
            for ($i=0; $i < $countColumns; $i++) { 
                $stmt->bindParam(':'.$this->columns[$i], $values[$i]);
            }
            $res = $stmt->execute();
            
            return $res;
        } catch (\PDOException $e) {
            Exception::alertMessage($e, "'insert()' error");
        }
    }

    public function update(array $values = [], int $primarykey)
    {

        $countColumns = count($this->columnsUpdate);

        try {
            $sql = "UPDATE $this->table SET ";

            for ($i=0; $i < $countColumns; $i++) {
                $sql .= $this->columnsUpdate[$i]." = '$values[$i]'". ", ";
            }

            $format = rtrim($sql, ", ");
            $where = " WHERE $this->columnPrimaryKey = $primarykey";
            
            $sqlComplete = $format.$where;
            
            $stmt = DB::prepare($sqlComplete);
            for ($i=0; $i < $countColumns; $i++) { 
                $stmt->bindParam(':'.$this->columnsUpdate[$i], $values[$i]);
            }
            $res = $stmt->execute();
            
            return $res;
        } catch (\PDOException $e) {
            Exception::alertMessage($e, "'update()' error");
        }
    }

    public function delete(int $primarykey, $all = false)
    {

        try {
            $sql = "DELETE FROM $this->table WHERE $this->columnPrimaryKey = $primarykey";
            if ($all == true) {
                $sql = "DELETE FROM $this->table";
            }

            $stmt = DB::prepare($sql);
            $res = $stmt->execute();
            
            return $res;
        } catch (\PDOException $e) {
            Exception::alertMessage($e, "'delete()' error");
        }
    }

    public function call(string $procedure, array $params = null)
    {

        $values = null;
        if ($params) {
            $values = implode(", ", $params);
        }

        try {
            $sql = "CALL $procedure($values)";
            $stmt = DB::prepare($sql);
            $res = $stmt->execute();
            
            return $res;
        } catch (\PDOException $e) {
            Exception::alertMessage($e, "'call()' error");
        }
    }
}
