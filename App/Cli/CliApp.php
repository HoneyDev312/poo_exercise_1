<?php

declare(strict_types=1);

namespace App\Cli;

use App\Repository\ContactManager;

// Orchestrateur CLI : lit l'entrée utilisateur et délègue aux services métier.
class CliApp
{
    // Commandes métier liées aux contacts (list, detail, create, update, delete)
    private Command $command;

    // Commande d'aide (help / aide)
    private HelpCommand $helpCommand;

    public function __construct()
    {
        // Initialise et instanciation des dépendances une seule fois au démarrage de l'application CLI
        $contactManager = new ContactManager();
        $this->command = new Command($contactManager);
        $this->helpCommand = new HelpCommand();
    }

    public function run(): void
    {
        // Boucle principale de lecture des commandes utilisateur tant que l'utilisateur ne quitte pas 
        while (true) {
            $line = trim(readline(
                PHP_EOL .
                    "Attention à la syntaxe des commandes, les espaces et virgules sont importants." .
                    PHP_EOL . PHP_EOL .
                    "Entrez votre commande (help, list, detail, create, update, delete, quit) : "
            ));

            echo PHP_EOL;

            // Liste tous les contacts
            if ($line === 'list') {
                $this->command->list();

                // Détail d'un contact: detail [id]
            } elseif (preg_match('/^detail\s+(?P<id>\d+)$/', $line, $matches)) {
                $this->command->detail((int) $matches['id']);

                // Création: create [name], [email], [phone_number]
            } elseif (preg_match('/^create\s+(?P<name>[^,]+)\s*,\s*(?P<email>[^,]+)\s*,\s*(?P<phone_number>[^,]+)$/', $line, $matches)) {
                $this->handleCreate($matches);

                // Mise à jour: update [id] [name], [email], [phone_number]
            } elseif (preg_match('/^update\s+(?P<id>\d+)\s+(?P<name>[^,]+)\s*,\s*(?P<email>[^,]+)\s*,\s*(?P<phone_number>[^,]+)$/', $line, $matches)) {
                $this->handleUpdate($matches);

                // Suppression: delete [id]
            } elseif (preg_match('/^delete\s+(?P<id>\d+)$/', $line, $matches)) {
                $this->command->delete((int) $matches['id']);

                // Aide
            } elseif ($line === 'help' || $line === 'aide') {
                $this->helpCommand->help();

                // Quitter l'application
            } elseif ($line === 'quit' || $line === 'q') {
                return;

                // Commande inconnue
            } else {
                echo "Cette commande n'est pas valide" . PHP_EOL;
            }
        }
    }

    private function handleCreate(array $matches): void
    {
        // Extrait et nettoie les valeurs capturées par la regex
        $name = trim($matches['name']);
        $email = trim($matches['email']);
        $phone = trim($matches['phone_number']);

        // Validation email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "Email invalide" . PHP_EOL;
            return;
        }

        // Validation téléphone FR simplifiée (10 chiffres)
        if (!preg_match('/^\d{10}$/', $phone)) {
            echo "Numéro invalide (10 chiffres attendus)" . PHP_EOL;
            return;
        }

        // Appel de la commande de création
        $this->command->create($name, $email, $phone);
    }

    private function handleUpdate(array $matches): void
    {
        // Extrait et nettoie les valeurs capturées par la regex
        $id = (int) $matches['id'];
        $name = trim($matches['name']);
        $email = trim($matches['email']);
        $phone = trim($matches['phone_number']);

        // Validation email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "Email invalide" . PHP_EOL;
            return;
        }

        // Validation téléphone FR simplifiée (10 chiffres)
        if (!preg_match('/^\d{10}$/', $phone)) {
            echo "Numéro invalide (10 chiffres attendus)" . PHP_EOL;
            return;
        }

        // Appel de la commande de mise à jour
        $this->command->update($id, $name, $email, $phone);
    }
}
