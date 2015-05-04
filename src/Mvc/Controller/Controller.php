<?php

namespace Mvc\Controller;

use Mvc\View\View;
use Mvc\Model\Model;
use Mvc\Core\Data;

class Controller
{
    private $model = null;

    private $data = null;

    public function __construct()
    {
        $this->model = new Model();
        $this->data = new Data();
    }

    public function gameNum()
    {
        $status = $this->model->gameNum($this->data->gameData());
        return View::render(array('status' => $status));
    }

    public function cusOrderResult()
    {
        $status = $this->model->cusOrderResult($this->data->gameData());

        return View::render(array('status' => $status));
    }

    public function result()
    {
        $status1 = $this->model->result($_GET['id']);
        $status2 = $this->model->gameResult($_GET['id']);
        return View::render(array('status' => $status1,'gameResult' => $status2));
    }
    public function gameid(){
        $status = $this->model->gameid();
        return View::render(array('status' => $status));
    }
}