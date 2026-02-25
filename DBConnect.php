<?php

declare(strict_types=1);

class DBConnect
{
    const MYSQL_HOST = '127.0.0.1';
    const MYSQL_PORT = 3306;
    const MYSQL_NAME = 'adress_book_manager';
    const MYSQL_USER = 'root';
    const MYSQL_PASSWORD = '';

    public ?\PDO $database = null;

    public function getConnection(): \PDO
    {

        if ($this->database === null) {
            $this->database = new \PDO(
                sprintf('mysql:host=%s;dbname=%s;port=%s;charset=utf8', self::MYSQL_HOST, self::MYSQL_NAME, self::MYSQL_PORT),
                self::MYSQL_USER,
                self::MYSQL_PASSWORD,
                [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION],
            );
        }
        return $this->database;
    }
}
