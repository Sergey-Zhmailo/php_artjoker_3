<?php

namespace controllers;
use \Logger as Logger;

class Import extends Controller{
    public function __construct()
    {
        parent::__construct();
    }

    public function csvImport($fileURL) {
        $logger = new \Logger();
        // import products
        $importFile =  $_SERVER['DOCUMENT_ROOT'] . $fileURL;
//        $importFile =  $_SERVER['DOCUMENT_ROOT'] . "/database/import.csv";
        if (file_exists($importFile)) {
            $i = 0;
            $file = fopen($importFile, 'r');
            $header = [];
            while (($line = fgetcsv($file)) !== FALSE) {
                if( $i==0 ) {
                    $header = $line;
                } else {
                    $data[] = $line;
                }
                $i++;
            }
            fclose($file);
            foreach ($data as $key => $lineValue) {
                $dataItem = array();
                foreach ($lineValue as $key => $value) {
                    $dataItem[ $header[$key] ] = $value;
                }
                $dataRes[] = $dataItem;
            }
            return $dataRes;
        } else {
            throw new Exception("No exist import file");
        }
    }


}