<?php

namespace Mvc\Model;


class Model
{
    private static $db = null;

    private $status = false;

    public function __construct($filename = null, $path = null)
    {
        try {
            self::$db = array();
            if (! $path) {
                $path = dirname(dirname(dirname(__DIR__))).'/config';
            }
            if (! $filename) {
                $filename = 'config.php';
            }
            self::$db = require(implode('/', array($path, $filename)));
            self::$db = new \PDO(self::$db['db']['dsn'], self::$db['db']['user'], self::$db['db']['pwd']);
            self::$db->query('set character set utf8');
            $this->status = true;
        } catch (PDOException $e) {
            $this->status = false;
            return;
        }
    }
    //寫入開獎號碼
    public function gameNum($data)
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
            //判斷重複輸入
            $aa = array($_num1, $_num2, $_num3, $_num4, $_num5, $_num6, $_num7);
            $aa_unique = array_unique($aa);

            if (!preg_match("/^([0-9]+)$/",$_num1)||!preg_match("/^([0-9]+)$/",$_num2)
                ||!preg_match("/^([0-9]+)$/",$_num3)||!preg_match("/^([0-9]+)$/",$_num4)
                ||!preg_match("/^([0-9]+)$/",$_num5)||!preg_match("/^([0-9]+)$/",$_num6)
                ||!preg_match("/^([0-9]+)$/",$_num7)) {
                return 'error1';
            } elseif (($_num1>49 || $_num1<1)||($_num2>49 || $_num2<1)||($_num3>49 || $_num3<1)
                    ||($_num4>49 || $_num4<1)||($_num5>49 || $_num5<1)||($_num6>49 || $_num6<1)
                    ||($_num7>49 || $_num7<1)) {
                return 'error2';
            } elseif ( count($aa) != count($aa_unique) ) {
                return 'error3';
            }
            else {
                $sql = self::$db->prepare(
                    "UPDATE game set num1=:num1, num2=:num2, num3=:num3, num4=:num4, num5=:num5, num6=:num6, num7=:num7
                where id = '".$_id."' ");

                $sql->bindvalue(':num1', $_num1);
                $sql->bindvalue(':num2', $_num2);
                $sql->bindvalue(':num3', $_num3);
                $sql->bindvalue(':num4', $_num4);
                $sql->bindvalue(':num5', $_num5);
                $sql->bindvalue(':num6', $_num6);
                $sql->bindvalue(':num7', $_num7);
                return ($sql->execute()) ? 'success' : false;
            }
        } catch (\PDOException $e) {
            return false;
        }
    }
    //orderlist
    public function cusOrder($data)
    {
        $sql = self::$db->prepare("SELECT id, gameid, number1, number2, number3, number4, number5, number6, number7
                                    FROM orders
                                    where gameid = '".$data['id']."' ");
        if ($sql->execute()) {
            $sql = $sql->fetchAll(\PDO::FETCH_ASSOC);
            return $sql;
        }
    }
    //比對寫入result
    public function cusOrderResult($gdata)
    {
        //gameorder
        $specilg['num7'] = array_pop($gdata);
        //userorder
        $cdata = $this->cusOrder($gdata);
        foreach($cdata as $key => $value ) {
            $specilc[$value['id']]['number7'] =array_pop($cdata[$key]);
            $gendata[$value['id']]=array_shift($cdata[$key]);
            $gendata[$value['id']]=array_shift($cdata[$key]);
            $cgendata[$value['id']]=$cdata[$key];
        }
        $gadata = array_shift($gdata);
        $ggendata = $gdata;

        foreach($cgendata as $key => $value ) {
            //比對一般選號
            $comparison_num=array_intersect($cgendata[$key], $ggendata);
            $genResult[$key] = count($comparison_num);
            //比對特別號
            $comparison_spe=array_intersect($specilc[$key], $specilg);
            $splResult[$key] = count($comparison_spe);
            if ($genResult[$key] == 6) {
                $result[$key] = 1 ;
            } elseif ($genResult[$key] == 5 && $splResult[$key] == 1) {
                $result[$key] = 2;
            } elseif ($genResult[$key] >= 2 && $splResult[$key] == 1) {
                $result[$key] = 3;

            } elseif ($genResult[$key] >= 3 ) {
                $result[$key] = 4;
            } else {
                $result[$key] = 5;
            }
        }
        try {
            $_result = $result ;
            foreach($_result as $key => $value ) {
                $_id = $key;
                $sql = self::$db->prepare(
                    "UPDATE orders set result=:result
                where id = '".$_id."' and gameid = '".$gadata."'");
                $sql->bindvalue(':result', $_result[$_id]);
                $sql->execute();
            }
          //  var_dump($_result);
            return $gadata;
        } catch (\PDOException $e) {
            return false;
        }
    }
    //result
    public function result($id)
    {
        $sql = self::$db->prepare("SELECT orders.id id, gameid, number1, number2, number3, number4, number5, number6, number7, result,date
                                    FROM orders
                                    INNER JOIN game on game.id = orders.gameid
                                    where gameid = '".$id."'
                                     ");
        if ($sql->execute()) {
            $sql = $sql->fetchAll(\PDO::FETCH_ASSOC);
            return $sql;

        } else {
            return false;
        }
    }
    //gameResult
    public function gameResult($id)
    {
        $sql = self::$db->prepare("SELECT num1, num2, num3, num4, num5, num6, num7 FROM game where id = '".$id."'");
        if ($sql->execute()) {
            $sql = $sql->fetch(\PDO::FETCH_ASSOC);
            return $sql;
        } else {
            return false;
        }
    }
    //gameid
    public function gameid()
    {
        $sql = self::$db->prepare("SELECT * FROM game");
        if ($sql->execute()) {
            $sql = $sql->fetchAll(\PDO::FETCH_ASSOC);
            return $sql;
        } else {
            return false;
        }
    }
}