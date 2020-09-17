<?php

namespace App\Core;

class Db extends \PDO
{
    private static $instance;

    public function __construct()
    {
        $dbConfig = Config::get('db');

        $dsn = 'mysql:host=' .
            $dbConfig['host'] .
            ';dbname=' .
            $dbConfig['name'] .
            ';charset=utf8';

        parent::__construct(
            $dsn,
            $dbConfig['user'],
            $dbConfig['password']
        );

        $this->setAttribute(
            \PDO::ATTR_DEFAULT_FETCH_MODE,
            \PDO::FETCH_OBJ
        );
    }

    public static function getInstance()
    {
        if (static::$instance === null) {
            self::$instance = new static();
        }

        return self::$instance;
    }
}