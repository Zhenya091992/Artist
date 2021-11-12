<?php

namespace Models;

class Photo extends Model
{
    // имя таблицы БД
    const TABLE = 'photo';

    public $namePhoto;
    public $nameFile;

    public function __construct()
    {
        parent::__construct();
    }

    //добавляем в базу данных фотографию, с проверкой на существующее название фотографии
    public function addPhoto(string $namePhoto, array $img)
    {
        $sql = "SELECT * FROM `" . self::TABLE . "` WHERE `namePhoto` = :namePhoto";
        $data = [':namePhoto' => $namePhoto];
        if (static::$connectDB->query($sql, $data, static::class)) {
            return false;
        } else {
            $nameFile = mt_rand(0, 10000) . $img['name'];
            $pathImg = __DIR__ . '/../../data/photo/' . $nameFile;
            $sqlAddPhoto = ("INSERT INTO `" . self::TABLE . "` (`namePhoto`, `nameFile`) VALUES (:namePhoto,:nameFile)");
            $data = [
                ':namePhoto' => $namePhoto,
                ':nameFile' => $nameFile
            ];
            if (static::$connectDB->execute($sqlAddPhoto, $data)) {
                return move_uploaded_file($img['tmp_name'], $pathImg);
            } else {
                return false;
            }
        }
    }

    public function deleteId($id)
    {
        if ($photo = self::findId($id)) {
            if (parent::deleteId($photo[0]->id)) {
                if (unlink(__DIR__ . '/../../data/photo/' . $photo[0]->nameFile)) {
                    return true;
                } else {
                    return  false;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}
