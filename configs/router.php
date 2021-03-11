<?php

return [
    "" => [
        "GET" => [
            "controller" => "\\controllers\\HomeController",
            "action" => "home",
            "params" => "",
        ],
    ],
    "category/(.*)/product/(.*)" => [
        "GET" => [
            "controller" => "\\controllers\\HomeController",
            "action" => "home",
            "params" => "$2/$1",
        ],
    ],
    "section" => [
        "GET" => [
            "controller" => "\\controllers\\HomeController",
            "action" => "section",
            "params" => "",
        ],
    ],
    "catalog" => [
        "GET" => [
            "controller" => "\\controllers\\Catalog",
            "action" => "catalog",
            "params" => "",
        ],
    ],
    "export/(.*)" => [
        "GET" => [
            "controller" => "\\controllers\\Export",
            "action" => "export",
            "params" => "$1",
        ],
    ],
];