<?php


namespace Models;


class Album extends \Models\ConnectDB
{
    public function __construct()
    {
        parent::__construct();
    }

    //получаем массив обЪектов альбомов
    public  function getAlbums()
    {
        return $this->getAll('aigel');
    }

    //создаем новую строку в базе данных с проверкой на наличие существующего альбома
    public function createAlbum(string $nameAlbum,string $dateRelise)
    {
        $sql = 'SELECT * FROM `aigel` WHERE `nameAlbum` = :nameAlbum';
        $data = [':nameAlbum' => $nameAlbum];
        if(static::$connectDB->query($sql, $data)) {
            return false;
        } else {
            $sqlSetAlbum = ("INSERT INTO `aigel` (`id`, `nameAlbum`, `dateRelise`) 
            VALUES (NULL, :nameAlbum, :dateRelise)");
            $data = [
                ':nameAlbum' => $nameAlbum,
                ':dateRelise' => $dateRelise,
            ];
            return static::$connectDB->execute($sqlSetAlbum, $data);
        }
    }
}