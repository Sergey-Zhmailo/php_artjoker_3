<?php

namespace controllers;

class Error extends Controller{
    public function __construct()
    {
        parent::__construct();
    }

    public function error(){
        $this->data("template", "error");
        $this->display("index");
    }
}