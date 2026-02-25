<?php

declare(strict_types=1);

namespace App\Repository;

require_once('App/Database/DBConnect.php');
require_once('App/Entity/Contact.php');

use App\Entity\Contact;
use App\Database\DBConnect;

class ContactManager
{

    private \PDO $connection;

    public function __construct()
    {
        $this->connection = (new DBConnect())->getConnection();
    }

    public function findAll(): array
    {
        $statement = $this->connection->prepare(
            "SELECT id, name, email, phone_number FROM contact"
        );

        $statement->execute();

        $contacts = [];

        while (($row = $statement->fetch())) {
            $contact = new Contact();
            $contact->id = (int) $row['id'];
            $contact->name = $row['name'];
            $contact->email = $row['email'];
            $contact->phone_number = $row['phone_number'];

            $contacts[] = $contact;
        }

        return $contacts;
    }
}
