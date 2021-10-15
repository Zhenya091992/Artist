<?php


namespace Models;


class Album extends \Models\ConnectDB
{
    // имя таблицы БД
    const TABLE = 'aigel';

    public function __construct()
    {
        parent::__construct();
    }

    //получаем массив обЪектов альбомов
    public  function getAlbums()
    {
        return $this->getAll(self::TABLE);
    }

    //создаем новую строку в базе данных с проверкой на наличие существующего альбома
    public function createAlbum(string $nameAlbum,string $dateRelise)
    {
        $sql = "SELECT * FROM `" . self::TABLE . "` WHERE `nameAlbum` = :nameAlbum";
        $data = [':nameAlbum' => $nameAlbum];
        if(static::$connectDB->query($sql, $data)) {
            return false;
        } else {
            $sqlSetAlbum = ("INSERT INTO `" . self::TABLE . "` (`id`, `nameAlbum`, `dateRelise`) 
            VALUES (NULL, :nameAlbum, :dateRelise)");
            $data = [
                ':nameAlbum' => $nameAlbum,
                ':dateRelise' => $dateRelise,
            ];
            return static::$connectDB->execute($sqlSetAlbum, $data);
        }
    }
}