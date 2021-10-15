<?php

class DB
{
    protected $connectDB;

    public function __construct($pathConfig)
    {
        $config = file($pathConfig, FILE_IGNORE_NEW_LINES);
        $this->connectDB = new \PDO($config[0], $config[1], $config[2]); // $config[0] - DSN, $config[1] - user, $config[2] - password
    }

    public function execute(string $sql, array $data = null)
    {
        $sth = $this->connectDB->prepare($sql);
        return $sth->execute($data);
    }

    public function query(string $sql, array $data = null)
    {
        $sth = $this->connectDB->prepare($sql);
        if ($sth->execute($data)) {
            return $sth->fetchAll(PDO::FETCH_OBJ);
        } else {
            return false;
        }
    }

    //генерирует запись за записью из ответа базы данных
    public function queryEach(string $sql)
    {
        $sth = $this->connectDB->prepare($sql);
        if ($sth->execute()) {
            $sth->setFetchMode(PDO::FETCH_OBJ);
            while ($string = $sth->fetch()) {
                yield $string;
            }
        } else {
            return false;
        }
    }
}

