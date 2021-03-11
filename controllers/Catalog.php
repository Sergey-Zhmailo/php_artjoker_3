<?php

namespace controllers;

class Catalog extends Controller{
    public function __construct()
    {
        parent::__construct();
    }

    public function catalog(){
        $this->loadModel("product", "Product");

        include $_SERVER['DOCUMENT_ROOT'] . "/database/database.php";

        $products = $database;

        $this->data("products", $products);

        $this->data("template", "catalog");
        $this->display("index");
    }
}