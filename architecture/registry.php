<?php
/**
 *  Паттерн - Реестр / Registry
 */

require_once $_SERVER['DOCUMENT_ROOT'] . '/helpers/helperOutput.php';

use function helperOutput\printArray;

class Register
{
    private static $data = [];

    public static function set(string $key,$value)
    {
        self::$data[$key] = $value;
    }

    public static function get(string $key, $defaultValue = null)
    {
        return self::$data[$key] ?? $defaultValue;
    }
}