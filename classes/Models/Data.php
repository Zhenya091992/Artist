<?php


namespace Models;


class Data extends \Models\ConnectDB
{
    public function __construct()
    {
        parent::__construct();
    }

    public static function getData(string $nameData)
    {
        $data = [':nameData' => $nameData];
        $sqlGetData = ("SELECT * FROM `data` WHERE `name` = :nameData");
        return static::$connectDB->query($sqlGetData, $data);
    }
}