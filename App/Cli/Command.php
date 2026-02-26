<?php

namespace App\Cli;

use App\Repository\ContactManager;

class Command
{
    // Constructeur de la classe. Initialise le manager de Contact
    public function __construct(private ContactManager $contactManager) {}

    public function list(): void
    {
        // Récupère puis affiche tous les contacts
        $contacts = $this->contactManager->findAll();

        if (empty($contacts)) {
            echo "Aucun contact" . PHP_EOL;
            return;
        }

        foreach ($contacts as $contact) {
            echo $contact;
        }
    }

    public function detail(int $id): void
    {
        // Récupère et affiche un contact à partir de son id
        $contact = $this->contactManager->findById($id);

        if (!$contact) {
            echo "Contact non trouvé" . PHP_EOL;
            return;
        }

        echo $contact;
    }

    public function create(string $name, string $email, string $phone_number): void
    {
        // Crée un nouveau contact en base
        $created = $this->contactManager->createContact($name, $email, $phone_number);

        if ($created) {
            echo "Nouveau contact ajouté." . PHP_EOL;
        } else {
            echo "une erreur s'est produite." . PHP_EOL;
        }
    }

    public function update(int $id, string $name, string $email, string $phone_number): void
    {
        // Update un contact existant à partir de son id
        $updated = $this->contactManager->updateContact($id, $name, $email, $phone_number);

        if ($updated) {
            echo "Contact mis à jour." . PHP_EOL;
        } else {
            echo "une erreur s'est produite." . PHP_EOL;
        }
    }

    public function delete(int $id): void
    {
        // Supprime un contact à partir de son id
        $deleted = $this->contactManager->delete($id);

        if ($deleted) {
            echo "Contact effacé." . PHP_EOL;
        } else {
            echo "une erreur s'est produite." . PHP_EOL;
        }
    }
}
