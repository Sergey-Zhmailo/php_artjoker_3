<?php

namespace controllers;
use controllers\Import as Import;
use \Logger as Logger;

class Export extends Controller{
    public function __construct()
    {
        parent::__construct();
    }

    public function export($type){
        $callFunc = $type . 'Export';
        self::$callFunc();
        if (!$type) {
            throw new Exception("Empty export type!");
        }
    }

    private function xmlExport() {
        $logger = new \Logger();
        // import products
        $import = new \controllers\Import();
        try {
            $products = $import->csvImport('/database/import.csv');
        } catch (\Exception $e) {
            $logger->error($e->getMessage(), $e->getFile(), $e->getLine());
        }

        if ($products) {
            $xml = new \DomDocument('1.0', 'utf-8');
            $main_title = $xml->appendChild($xml->createElement('title'));
            $main_title->appendChild($xml->createTextNode('Export XML'));
            $products_list = $xml->appendChild($xml->createElement('products'));

            foreach ($products as $item) {
                $product = $products_list->appendChild($xml->createElement('product'));
                $id = $product->appendChild($xml->createElement('id'));
                $id->appendChild($xml->createTextNode($item['id']));
                $name = $product->appendChild($xml->createElement('name'));
                $name->appendChild($xml->createTextNode($item['title']));
                $price = $product->appendChild($xml->createElement('price'));
                $price->appendChild($xml->createTextNode($item['price']));
            }

            $xml->formatOutput = true;

            $xml->save('export.xml');

            // Download export XML
            $exportXml = 'export.xml';
            if (file_exists($exportXml)) {
                header('Content-Description: File Transfer');
                header('Content-Type: application/octet-stream');
                header('Content-Disposition: attachment; filename="'.basename($exportXml).'"');
                header('Expires: 0');
                header('Cache-Control: must-revalidate');
                header('Pragma: public');
                header('Content-Length: ' . filesize($exportXml));
                readfile($exportXml);
                exit;
            }
        } else {
            throw new Exception("No one product to export");
        }
    }

    private function csvExport() {
        $logger = new \Logger();
        // import products
        $import = new \controllers\Import();
        try {
            $products = $import->csvImport('/database/import.csv');
        } catch (\Exception $e) {
            $logger->error($e->getMessage(), $e->getFile(), $e->getLine());
        }

        if ($products) {
            $exportCSV = 'export.csv';
            $headers = [];
            foreach ($products[0] as $key=>$header) {
                $headers[] = $key;
            }
            $fp = fopen($exportCSV, 'w');
            if ($fp && $products) {

                fputcsv($fp, $headers);
                foreach ($products as $fields) {
                    fputcsv($fp, $fields);
                }
            }
            fclose($fp);

            // Download export CSV
            if (file_exists($exportCSV)) {
                header('Content-Description: File Transfer');
                header('Content-Type: text/csv');
                header('Content-Disposition: attachment; filename="'.basename($exportCSV).'"');
                header('Expires: 0');
                header('Cache-Control: must-revalidate');
                header('Pragma: public');
                header('Content-Length: ' . filesize($exportCSV));
                readfile($exportCSV);
                exit;
            }
        } else {
            throw new Exception("No one product to export");
        }
    }
    private function jsonExport() {
        $logger = new \Logger();
        // import products
        $import = new \controllers\Import();
        try {
            $products = $import->csvImport('/database/import.csv');
        } catch (\Exception $e) {
            $logger->error($e->getMessage(), $e->getFile(), $e->getLine());
        }

        $exportJSON = 'export.json';

        if ($products) {
            $fp = fopen($exportJSON, 'w');
            fwrite($fp, json_encode($products));
            fclose($fp);

            // Download export JSON
            if (file_exists($exportJSON)) {
                header('Content-Description: File Transfer');
                header('Content-Type: application/json');
                header('Content-Disposition: attachment; filename="'.basename($exportJSON).'"');
                header('Expires: 0');
                header('Cache-Control: must-revalidate');
                header('Pragma: public');
                header('Content-Length: ' . filesize($exportJSON));
                readfile($exportJSON);
                exit;
            }
        } else {
            throw new Exception("No one product to export");
        }
    }
}