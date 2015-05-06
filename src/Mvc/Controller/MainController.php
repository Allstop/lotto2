<?php

namespace Mvc\Controller;

use Mvc\Sys\controller;
use Mvc\View\View;
use Mvc\Model\gameModel;
use Mvc\Model\orderModel;

class MainController extends controller
{
    private $gameModel = null;

    private $orderModel = null;

    private $data = null;

    public function __construct()
    {
        controller::init();

        $this->gameModel = new gameModel();

        $this->orderModel = new orderModel();

        $this->data = self::$app->getInput();
    }

//寫入game中獎號碼
    public function gameNumUpdate()
    {
        //判斷是否重複
        $aa = array_slice($this->data->getData(), 1);
        $aa_unique = array_unique($aa);
        //判斷只能輸入數字
        if (!preg_match("/^([0-9]+)$/", max($aa))) {
            return View::render(array('status' => 'error1'));
            //判斷輸入1~49
        } elseif (max($aa)>49 || min($aa)<1 ) {
            return View::render(array('status' => 'error2'));
            //判斷重複輸入
        } elseif ( count($aa) != count($aa_unique) ) {
            return View::render(array('status' => 'error3'));
        } else {
            $status = $this->gameModel->gameNumUpdate($this->data->getData());
            return View::render(array('status' => $status));
        }
    }
//寫入Orders中獎結果
    public function orderResultUpdate()
    {
        //gameNum
        $gameSpecialNum = array_slice($this->data->getData(), 7);
        $gameGeneralNum = array_slice($this->data->getData(), 1, -1);
        //OrderNum
        $cdata = $this->orderModel->ordersResult($this->data->getData()['id']);
        foreach($cdata as $key => $value ) {
            $OrderSpecialNum[$value['id']] =array_slice($value, 10);
            $OrderGeneralNum[$value['id']]=array_slice($value, 4, -1);
        }
        foreach($OrderGeneralNum as $key => $value ) {
            //比對一般選號
            $comparison_num=array_intersect($OrderGeneralNum[$key], $gameGeneralNum);
            $genResult[$key] = count($comparison_num);
            //比對特別號
            $comparison_spe=array_intersect($OrderSpecialNum[$key], $gameSpecialNum);
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
        $status = $this->orderModel->orderResultUpdate($this->data->getData(), $result);
        return View::render(array('status' => $status));
    }
//顯示結果清單
    public function ordersResult()
    {
        $status1 = $this->orderModel->ordersResult($_GET['id']);
        $status2 = array_slice($this->gameModel->gameResult($_GET['id'])[0], 2);
        return View::render(array('status' => $status1,'gameResult' => $status2));
    }
//顯示所有期數
    public function gameResult(){
        $status = $this->gameModel->gameResult('');
        return View::render(array('status' => $status));
    }
}