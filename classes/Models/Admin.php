<?php

namespace Models;

class Admin extends ConnectDB
{
    public function __construct()
    {
        parent::__construct();
    }
    //проверка логина и пароля из базы данных
    public function signIn(string $login, string $password)
    {
        $data = [':login' => $login];
        $sql = 'SELECT * FROM `admin` WHERE `login` = :login';
        $reg = static::$connectDB->query($sql, $data);
        if (isset($reg)) {
            return password_verify($password, $reg[0]->password);
        } else {
            return false;
        }
    }

    //запись в базу данных уникального ключа сессии при осуществлении входа
    public function openSession(string $login, int $session)
    {
        $data = [
            ':session' => $session,
            ':login' => $login
        ];
        $sql = 'UPDATE `admin` SET `session`=:session WHERE `login`=:login';
        return static::$connectDB->execute($sql, $data);
    }

    //проверка текущей сессии с сессией в базе данных
    public function checkSession(array $session)
    {
        if (!empty($session['login']) && !empty($session['session'])) {
            $data = [
                ':login' => $session['login'],
                ':session' => $session['session']
            ];
            $sql = 'SELECT * FROM `admin` WHERE `login` = :login AND `session` = :session';
            return static::$connectDB->query($sql, $data);
        } else {
            return false;
        }
    }
}