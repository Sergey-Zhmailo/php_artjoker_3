<?php
class Logger {
    private static $instance;
    public static $fileUrl = __DIR__ . '/logs/' . '/log.txt';
    public static $dateFormat = 'Y-m-d H:i:s';

    // Конфиг уровеня логов
    public static $mode = ['error', 'warning', 'debug'];

    public function __construct()
    {
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    private function checkLevel($mode, $type) {
        if (in_array($type, $mode)) {
            return true;
        } else {
            return false;
        }
    }

    private function write($level, $message, $file, $line) {
        if (!$message) {
            $message = 'Cообщение не указано';
        }
        if (!$file) {
            $file = 'Файл не указан';
        }
        if (!$line) {
            $line = '-';
        }

        $log = date(self::$dateFormat) . ' [' . $level . '] "' . $message . '" in ' . $file . ' line ' . $line . ';';
        file_put_contents(self::$fileUrl, $log . PHP_EOL, FILE_APPEND);
    }

    public function debug($message, $file, $line) {
        $type = 'debug';
        if (self::checkLevel(self::$mode, $type)) {
            self::write('DEBUG', $message, $file, $line);
        }
    }
    public function info($message, $file, $line) {
        $type = 'info';
        if (self::checkLevel(self::$mode, $type)) {
            self::write('INFO', $message, $file, $line);
        }
    }
    public function warning($message, $file, $line) {
        $type = 'warning';
        if (self::checkLevel(self::$mode, $type)) {
            self::write('WARNING', $message, $file, $line);
        }
    }
    public function error($message, $file, $line) {
        $type = 'error';
        if (self::checkLevel(self::$mode, $type)) {
            self::write('ERROR', $message, $file, $line);
        }
    }

    private function __sleep()
    {

    }

    private function __wakeup()
    {

    }
}