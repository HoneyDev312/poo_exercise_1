<?php

declare(strict_types=1);

// // Charge automatiquement les classes à partir de leur namespace (App\Xxx => App/Xxx.php)
spl_autoload_register(static function (string $fqcn) {
    $path = str_replace('\\', '/', $fqcn) . '.php';

    if (file_exists($path)) {
        require_once $path;
    }
});

use App\Repository\ContactManager;
use App\Cli\Command;
use App\Cli\HelpCommand;

while (true) {
    // Lecture de la commande utilisateur (CLI)
    $line = trim(readline(PHP_EOL . "Attention à la syntaxe des commandes, les espaces et virgules sont importants." . PHP_EOL . PHP_EOL . "Entrez votre commande (help, list, detail, create, delete, quit) : "));
    echo PHP_EOL;
    if ($line === "list") {
        // Liste tous les contacts
        $contactManager = new ContactManager();
        $command = new Command($contactManager);
        $command->list();
    } elseif (preg_match('/^detail\s+(?P<id>\d+)$/', $line, $matches)) {
        // Affiche un contact par son ID
        $id = (int) $matches['id'];
        $contactManager = new ContactManager();
        $command = new Command($contactManager);
        $command->detail($id);
    } elseif (preg_match(
        '/^create\s+(?P<name>[^,]+)\s*,\s*(?P<email>[^,]+)\s*,\s*(?P<phone_number>[^,]+)$/',
        $line,
        $matches
    )) {
        // Crée un contact après validation email/téléphone
        $name = trim($matches['name']);
        $email = trim($matches['email']);
        $phone_number = trim($matches['phone_number']);

        if (!preg_match('/^[^\s@]+@[^\s@]+\.[^\s@]+$/', $email)) {
            echo "Email invalide" . PHP_EOL;
        } elseif (!preg_match('/^\d{10}$/', $phone_number)) {
            echo "Numéro invalide (10 chiffres attendus)" . PHP_EOL;
        } else {
            $contactManager = new ContactManager();
            $command = new Command($contactManager);
            $command->create($name, $email, $phone_number);
        }
    } elseif (preg_match(
        '/^update\s+(?P<id>\d+)\s+(?P<name>[^,]+)\s*,\s*(?P<email>[^,]+)\s*,\s*(?P<phone_number>[^,]+)$/',
        $line,
        $matches
    )) {
        // Update un contact après validation email/téléphone
        $id = (int) $matches['id'];
        $name = trim($matches['name']);
        $email = trim($matches['email']);
        $phone_number = trim($matches['phone_number']);

        if (!preg_match('/^[^\s@]+@[^\s@]+\.[^\s@]+$/', $email)) {
            echo "Email invalide" . PHP_EOL;
        } elseif (!preg_match('/^\d{10}$/', $phone_number)) {
            echo "Numéro invalide (10 chiffres attendus)" . PHP_EOL;
        } else {
            $contactManager = new ContactManager();
            $command = new Command($contactManager);
            $command->update($id, $name, $email, $phone_number);
        }
    } elseif (preg_match('/^delete\s+(?P<id>\d+)$/', $line, $matches)) {
        // Supprime un contact par son ID
        $id = (int) $matches['id'];
        $contactManager = new ContactManager();
        $command = new Command($contactManager);
        $command->delete($id);
    } elseif ($line === "help" || $line === "aide") {
        // Affiche l'aide des commandes disponibles
        $command = new HelpCommand();
        $command->help();
    } elseif ($line === "quit" || $line === "q") {
        // Quitte proprement la boucle CLI
        return;
    } else {
        echo PHP_EOL . "Cette commande n'est pas valide" . PHP_EOL;
    }
}
