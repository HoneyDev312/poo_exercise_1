<?php

declare(strict_types=1);

namespace App\Database;

require_once('config.php');

class DBConnect
{

    public ?\PDO $database = null;

    public function getConnection(): \PDO
    {

        if ($this->database === null) {
            $this->database = new \PDO(
                sprintf('mysql:host=%s;dbname=%s;port=%s;charset=utf8', MYSQL_HOST, MYSQL_NAME, MYSQL_PORT),
                MYSQL_USER,
                MYSQL_PASSWORD,
                [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION],
            );
        }
        return $this->database;
    }
}
