<?php
while (true) {
    $line = readline("Entrez votre commande : ");
    if ($line === "list") {
        echo "Affichage de la list";
        $connection = new DBConnect;
        var_dump($connection);
        $manager = new ContactManager;
        $test =  $manager->findAll();
        var_dump($test);
        $contact = new Contact;
        $test2 =  $contact->toString();
        var_dump($test2);
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

class ContactManager
{

    public function findAll(): array
    {
        $contacts = [];
        return $contacts;
    }
}

class Contact
{
    private int $id;
    private string $name;
    private string $email;
    private string $phone_number;

    public function getId(): int|null
    {
        return self::$id;
    }

    public function getName(): string|null
    {
        return self::$name;
    }

    public function setName(string $name) {}

    public function getEmail(): string|null
    {
        return self::$email;
    }

    public function setEmail(string $email) {}

    public function getPhoneNumber(): string|null
    {
        return self::$phone_number;
    }

    public function setPhoneNumber(string $phone_number) {}

    public function toString(): string
    {
        return 'test de base';
    }
}
