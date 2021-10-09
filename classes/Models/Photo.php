<?php

namespace Models;

class Photo extends ConnectDB
{
    public function __construct()
    {
        parent::__construct();
    }

    //получаем массив обЪектов таблицы фотографий
    public function getPhoto()
    {
        return static::getAll('photo');
    }

    //добавляем в базу данных фотографию, с проверкой на существующее название фотографии
    public function addPhoto(string $namePhoto, array $img)
    {
        $sql = 'SELECT * FROM `photo` WHERE `namePhoto` = :namePhoto';
        $data = [':namePhoto' => $namePhoto];
        if (static::$connectDB->query($sql, $data)) {
            return false;
        } else {
            $nameFile = mt_rand(0, 10000) . $img['file']['name'];
            $pathImg = __DIR__ . '/../../data/photo/' . $nameFile;
            $sqlAddPhoto = ("INSERT INTO `photo` (`namePhoto`, `nameFile`) VALUES (:namePhoto,:nameFile)");
            $data = [
                ':namePhoto' => $namePhoto,
                ':nameFile' => $nameFile
            ];
            if (static::$connectDB->execute($sqlAddPhoto, $data)) {
                return move_uploaded_file($img['file']['tmp_name'], $pathImg);
            } else {
                return false;
            }
        }
    }
}
