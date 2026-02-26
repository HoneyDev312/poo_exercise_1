<?php

declare(strict_types=1);

namespace App\Database;

//Require des constantes de connection
require_once('config.php');

class DBConnect
{
    // Stocke la connexion PDO pour la réutiliser (évite de recréer la connexion à chaque appel)
    public ?\PDO $database = null;

    public function getConnection(): \PDO
    {
        // Crée la connexion seulement si elle n'existe pas encore
        if ($this->database === null) {
            $this->database = new \PDO(
                sprintf('mysql:host=%s;dbname=%s;port=%s;charset=utf8', MYSQL_HOST, MYSQL_NAME, MYSQL_PORT),
                MYSQL_USER,
                MYSQL_PASSWORD,
                [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION],
            );
        }
        // Retourne la connexion PDO active
        return $this->database;
    }
}
