<?php

namespace App\Cli;

use App\Repository\ContactManager;

class Command
{
    public function __construct(private ContactManager $contactManager) {}

    public function list(): void
    {
        $contacts = $this->contactManager->findAll();

        foreach ($contacts as $contact) {
            echo $contact;
        }
    }

    public function detail(int $id): void
    {
        $contact = $this->contactManager->findById($id);

        echo $contact;
    }

    public function create(string $name, string $email, string $phone_number): void
    {
        $created = $this->contactManager->createContact($name, $email, $phone_number);

        if ($created) {
            echo "Nouveau contact ajouté." . PHP_EOL;
        } else {
            echo "une erreur s'est produite." . PHP_EOL;
        }
    }

    public function update(int $id, string $name, string $email, string $phone_number): void
    {
        $updated = $this->contactManager->updateContact($id, $name, $email, $phone_number);

        if ($updated) {
            echo "Contact mis à jour." . PHP_EOL;
        } else {
            echo "une erreur s'est produite." . PHP_EOL;
        }
    }

    public function delete(int $id): void
    {
        $deleted = $this->contactManager->delete($id);

        if ($deleted) {
            echo "Contact effacé." . PHP_EOL;
        } else {
            echo "une erreur s'est produite." . PHP_EOL;
        }
    }
}
