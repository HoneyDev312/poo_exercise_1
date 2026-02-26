<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Contact;
use App\Database\DBConnect;

class ContactManager
{

    private \PDO $connection;

    public function __construct()
    {
        // Récupère une connexion PDO à la base de données
        $this->connection = (new DBConnect())->getConnection();
    }

    public function findAll(): array
    {
        // Récupère tous les contacts
        $statement = $this->connection->prepare(
            "SELECT id, name, email, phone_number FROM contact"
        );

        $statement->execute();

        $contacts = [];

        // Transforme chaque ligne SQL en objet Contact
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

    public function findById(string $id)
    {
        // Récupère un contact à partir de son id
        $statement = $this->connection->prepare(
            "SELECT id, name, email, phone_number FROM contact WHERE id = :id"
        );

        $statement->execute(['id' => $id]);

        $contact = "";

        while (($row = $statement->fetch())) {
            $contact = new Contact();
            $contact->id = (int) $row['id'];
            $contact->name = $row['name'];
            $contact->email = $row['email'];
            $contact->phone_number = $row['phone_number'];
        }

        return $contact;
    }

    public function createContact(string $name, string $email, string $phone_number): bool
    {
        // Insère un nouveau contact en base
        $statement = $this->connection->prepare(
            "INSERT INTO contact(name, email, phone_number) VALUES (:name, :email, :phone_number)"
        );

        $affectedLines = $statement->execute([
            'name' => $name,
            'email' => $email,
            'phone_number' => $phone_number,
        ]);

        return ($affectedLines > 0);
    }

    public function updateContact(int $id, string $name, string $email, string $phone_number): bool
    {
        // Met à jour un contact existant
        $statement = $this->connection->prepare(
            "UPDATE contact SET name = :name , email = :email, phone_number =:phone_number WHERE id = :id"
        );

        $affectedLines = $statement->execute([
            'id' => $id,
            'name' => $name,
            'email' => $email,
            'phone_number' => $phone_number,
        ]);

        return ($affectedLines > 0);
    }

    public function delete(string $id): bool
    {
        // Supprime un contact par son id
        $statement = $this->connection->prepare(
            "DELETE FROM contact WHERE id = :id"
        );

        $affectedLines = $statement->execute(['id' => $id]);

        return ($affectedLines > 0);
    }
}
