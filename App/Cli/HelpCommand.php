<?php

declare(strict_types=1);

namespace App\Cli;

class HelpCommand
{

    public function help(): void
    {
        // Affiche la liste des commandes disponibles et leur syntaxe
        echo
        "help : affiche cette aide" . PHP_EOL . PHP_EOL .
            "list : liste les contacts" . PHP_EOL . PHP_EOL .
            "detail [id] : affiche un contact à partir de son id" . PHP_EOL . PHP_EOL .
            "create [name], [email], [phone number] : crée un contact" . PHP_EOL . PHP_EOL .
            "update [id] [name], [email], [phone number] : met à jour un contact" . PHP_EOL . PHP_EOL .
            "delete [id] : supprime un contact" . PHP_EOL . PHP_EOL .
            "quit : quitte le programme" . PHP_EOL;
    }
}
