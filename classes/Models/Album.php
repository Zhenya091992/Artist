<?php

namespace Models;

class Album extends \Models\Model
{
    // имя таблицы БД
    const TABLE = 'aigel';

    public $nameAlbum;
    public $dateRelise;

    public function __construct()
    {
        parent::__construct();
    }

    //создаем новую строку в базе данных с проверкой на наличие существующего альбома
    public function createAlbum(string $nameAlbum, string $dateRelise)
    {
        $sql = "SELECT * FROM `" . self::TABLE . "` WHERE `nameAlbum` = :nameAlbum";
        $data = [':nameAlbum' => $nameAlbum];
        if (static::$connectDB->query($sql, $data, static::class)) {
            return false;
        } else {
            $this->nameAlbum = $nameAlbum;
            $this->dateRelise = $dateRelise;
            return $this->insert();
        }
    }
}
