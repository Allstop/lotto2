<?php

namespace Mvc\Model;

use Mvc\Sys\model;

class orderModel extends model
{
    private static $db = null;

    private $status = false;

    public function __construct()
    {
        model::init();

        self::$db = self::$app->getDB();
    }
    //比對寫入Orders中獎結果
    public function orderResultUpdate($data, $result)
    {
        if ($this->status != true) {
            return false;
        }
        try {
            $_result = $result ;
            $_gameId = $data['id'] ;
            foreach($_result as $key => $value ) {
                $_id = $key;
                $sql = self::$db->prepare(
                    "UPDATE orders set result=:result where id=:id and gameid=:gameid");
                $sql->bindvalue(':result', $_result[$_id]);
                $sql->bindvalue(':gameid', $_gameId);
                $sql->bindvalue(':id', $_id);
                $sql->execute();
            }
            return $_gameId;
        } catch (\PDOException $e) {
            return false;
        }
    }
    //ordersResult
    public function ordersResult($id)
    {
        $_id = $id ;
        $sql = self::$db->prepare("SELECT orders.id id, gameid, date, result, number1, number2, number3, number4, number5, number6, number7
                                    FROM orders
                                    INNER JOIN game on game.id = orders.gameid
                                    where gameid = :id
                                     ");
        $sql->bindvalue(':id', $_id);
        if ($sql->execute()) {
            $sql = $sql->fetchAll(\PDO::FETCH_ASSOC);
            return $sql;

        } else {
            return false;
        }
    }
}