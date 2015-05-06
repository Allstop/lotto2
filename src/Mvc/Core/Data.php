<?php

namespace Mvc\Core;

class Data
{
    public function gameData()
    {
        $gameData = array();
        foreach($_POST as $key => $value ) {
            $_POST[$key] = trim($value);
        }
        if (isset($_POST['id'])) {
            $gameData['id'] = $_POST['id'];
        }
        if (isset($_POST['date'])) {
            $gameData['date'] = $_POST['date'];
        }
        if (isset($_POST['num1'])) {
            $gameData['num1'] = $_POST['num1'];
        }
        if (isset($_POST['num2'])) {
            $gameData['num2'] = $_POST['num2'];
        }
        if (isset($_POST['num3'])) {
            $gameData['num3'] = $_POST['num3'];
        }
        if (isset($_POST['num4'])) {
            $gameData['num4'] = $_POST['num4'];
        }
        if (isset($_POST['num5'])) {
            $gameData['num5'] = $_POST['num5'];
        }
        if (isset($_POST['num6'])) {
            $gameData['num6'] = $_POST['num6'];
        }
        if (isset($_POST['num7'])) {
            $gameData['num7'] = $_POST['num7'];
        }
        return $gameData;
    }
}