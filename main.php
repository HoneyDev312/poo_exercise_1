<?php
while (true) {
    $line = readline("Entrez votre commande : ");
    if ($line === "list") {
        echo "Affichage de la list";
        $connection = new DBConnect;
        $test = $connection->getConnection();
        var_dump($connection);
        var_dump($test);
        return;
    } else {
        echo "Vous avez saisi : $line\n";
    }
}


class DBConnect
{
    const MYSQL_HOST = '127.0.0.1';
    const MYSQL_PORT = 3306;
    const MYSQL_NAME = 'artbox';
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
