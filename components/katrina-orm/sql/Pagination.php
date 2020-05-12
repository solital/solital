<?php

namespace Component\Katrina;
use PDO;

abstract class Pagination
{

    public function pagination(string $table, int $limit, string $previous_name = "<<", string $next_name = ">>", string $page = "page")
    {

        if ($limit == 0 || $limit <= 0) {
            Exception::message("'pagination()' error - Division by zero");
        }

        $pg = (isset($_GET[$page])) ? (int)$_GET[$page] : 1;
        $start = ($pg * $limit) - $limit;

        try {
            $sql = "SELECT * FROM $table LIMIT $start, $limit";
            $stmt = DB::query($sql);
            $stmt->execute();
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $sql = "SELECT * FROM $table";
            $stmt = DB::query($sql);
            $stmt->execute();
            $count = $stmt->rowCount();
            $total = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $qtdPag = ceil($count/$limit);

            $html = "<a href='?$page=1' class='pagination_first_item'>$previous_name</a> ";

            if($qtdPag > 1 && $pg<= $qtdPag){
                for($i=1; $i <= $qtdPag; $i++){
                    if($i == $pg){
                        $html .= " <span class='pagination_atual_item'>".$i."</span> ";
                    } else {
                        $html .= " <a href='?$page=$i' class='pagination_others_itens'>".$i."</a> ";
                    }
                }
            }

            $html .= " <a href=\"?$page=$qtdPag\" class='pagination_last_item'>$next_name</a>";

            return [
                "rows" => $rows, 
                "arrows" => $html
            ];
        } catch (\PDOException $e) {
            Exception::alertMessage($e, "'pagination()' error");
        }
    }
}
