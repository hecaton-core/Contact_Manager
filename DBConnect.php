<?php

class DBConnect // s'occupe de créer une connexion
{
    public function getNewPDO(): PDO
    {
        $config = require __DIR__ . '/config.php';
        return new PDO("mysql:host={$config['host']}; dbname={$config['dbname']}; charset=utf8mb4", $config['username'], $config['password']);
    }
}