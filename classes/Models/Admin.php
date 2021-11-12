<?php

namespace Models;

class Admin extends Model
{
    const TABLE = 'admin';

    public function __construct()
    {
        parent::__construct();
    }

    //проверка логина и пароля из базы данных
    public static function signIn(string $login, string $password)
    {
        $data = [':login' => $login];
        $sql = 'SELECT * FROM `' . static::TABLE . '` WHERE `login` = :login';
        $reg = static::$connectDB->query($sql, $data, static::class);
        if (isset($reg)) {
            return password_verify($password, $reg[0]->password);
        } else {
            return false;
        }
    }

    //проверка текущей сессии
    public static function checkSession(array $session)
    {
        if (!empty($session['login'])) {
            $data = [':login' => $session['login'],];
            $sql = 'SELECT * FROM `' . static::TABLE . '` WHERE `login` = :login';
            return static::$connectDB->query($sql, $data, self::class);
        } else {
            return false;
        }
    }
}
