<?php


namespace Models;


abstract class ConnectDB
{
    public static $connectDB;

    public function __construct()
    {
        self::$connectDB = new \DB(__DIR__ . '/../../config.txt');
    }

    public static function getAll($nameTable)
    {
        $sqlGet = ("SELECT * FROM $nameTable");
        return self::$connectDB->queryEach($sqlGet);
    }
}