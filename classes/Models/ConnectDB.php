<?php


namespace Models;


class ConnectDB
{
    public static $connectDB;

    public function __construct()
    {
        self::$connectDB = new \DB(__DIR__ . '/../../config.txt');
    }

    public static function getAll($nameTable)
    {
        $sqlGet = ("SELECT * FROM $nameTable");
        return self::$connectDB->query($sqlGet);
    }
}