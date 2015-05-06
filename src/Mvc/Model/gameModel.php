<?php

namespace Mvc\Model;

use Mvc\Sys\model;

class gameModel extends model
{
    private static $db = null;

    private $status = false;

    public function __construct()
    {
        model::init();

        self::$db = self::$app->getDB();
    }
    //寫入game中獎號碼
    public function gameNumUpdate($data)
    {
        if ($this->status != true) {
            return false;
        }
        try {
            $_id = $data['id'];
            $_num1 = $data['num1'];
            $_num2 = $data['num2'];
            $_num3 = $data['num3'];
            $_num4 = $data['num4'];
            $_num5 = $data['num5'];
            $_num6 = $data['num6'];
            $_num7 = $data['num7'];
            $sql = self::$db->prepare(
                "UPDATE game set num1=:num1, num2=:num2, num3=:num3, num4=:num4, num5=:num5, num6=:num6, num7=:num7
            where id=:id");
            $sql->bindvalue(':id', $_id);
            $sql->bindvalue(':num1', $_num1);
            $sql->bindvalue(':num2', $_num2);
            $sql->bindvalue(':num3', $_num3);
            $sql->bindvalue(':num4', $_num4);
            $sql->bindvalue(':num5', $_num5);
            $sql->bindvalue(':num6', $_num6);
            $sql->bindvalue(':num7', $_num7);
            return ($sql->execute()) ? 'success' : false;
        } catch (\PDOException $e) {
            return false;
        }
    }
    //gameResult
    public function gameResult($id)
    {

        if (!empty($id)){
            $_id = $id ;
            $sql = self::$db->prepare("SELECT * FROM game where id = :id");
            $sql->bindvalue(':id', $_id);
        } else {
            $sql = self::$db->prepare("SELECT * FROM game");
        }
        if ($sql->execute()) {
            $sql = $sql->fetchAll(\PDO::FETCH_ASSOC);
            return $sql;
        } else {
            return false;
        }
    }
}