<?php

namespace Models;

abstract class Model
{
    const TABLE = '';

    public $id;
    public static $connectDB;

    public function __construct()
    {
        self::$connectDB = new \DB(__DIR__ . '/../../config.txt');
    }

    public static function getAll()
    {
        $sqlGet = ("SELECT * FROM " . static::TABLE);
        return static::$connectDB->queryEach($sqlGet);
    }

    public static function findId(int $id)
    {
        $data = [':id' => $id];
        $sqlFind = ("SELECT * FROM " . static::TABLE . " WHERE `id` = :id");
        return static::$connectDB->query($sqlFind, $data, static::class);
    }

    public function insert()
    {
        $data = [];
        $properties = [];
        foreach ($this as $key => $value) {

            if ('id' == $key) {
                continue;
            }
            $properties[] = $key;
            $data[':' . $key] = $value;
        }

        $sqlInsert = ("INSERT INTO " . static::TABLE . " (`" . implode('`, `', $properties) . "`) 
        VALUES (" . implode(', ', array_keys($data)) . ")");
        return static::$connectDB->query($sqlInsert, $data, static::class);
    }

    public function update($data)
    {
        $sqlShortFragment = [];
        foreach ($this as $key => $value) {
            if ('id' == $key) {
                continue;
            }
            $sqlShortFragment[] = "`$key` = :$key ";
            $sqlFragment = implode(', ', $sqlShortFragment);
        }

        $sqlUpdate = ("UPDATE " . static::TABLE . " SET " . $sqlFragment .
            " WHERE " . "`id`=:id");
        return static::$connectDB->query($sqlUpdate, $data, static::class);
    }

    public function deleteId($id)
    {
        $data = [':id' => $id];
        $sqlDelete = ("DELETE FROM " . static::TABLE . " WHERE `id`=:id");
        return static::$connectDB->query($sqlDelete, $data, static::class);
    }
}
