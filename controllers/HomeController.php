<?php

namespace controllers;

class HomeController extends Controller{
    public function __construct()
    {
        parent::__construct();
    }

    public function home($a = 0, $b = 0){
        $result = (int)$a - (int)$b;

        $this->loadModel("user", "User");

        $users = $this->user->getAll();


        $this->data("seoDescription", "Самый лучший сайт");
        $this->data("result", $result);
        $this->data("users", $users);
        $this->data("template", "home");
        $this->display("index");
    }

    public function section(){
        $this->data("template", "section");
        $this->data("seoDescription", "section Самый лучший сайт");
        $this->display("index");
    }
}