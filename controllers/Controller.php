<?php

namespace controllers;

use \configs\Consts;

class Controller{

    private $data = [];

    public function __construct()
    {
    }

    public function loadModel($alias, $title){
        $model = "\\models\\" . $title;
        $this->$alias = new $model();
    }

    public function data($variable, $value){
        $this->data[$variable] = $value;
    }

    public function display($viewTitle){
        $path = Consts::DOCUMENT_ROOT . "/views/" . $viewTitle . ".php";
        if(file_exists($path)){
            \extract($this->data);
            require_once($path);
        }
    }
}