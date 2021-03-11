<?php

namespace controllers;

class Catalog extends Controller{
    public function __construct()
    {
        parent::__construct();
    }

    public function catalog(){
        $this->loadModel("product", "Product");

        $this->data("template", "catalog");
        $this->display("index");
    }
}