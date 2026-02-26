<?php

namespace App\Cli;

class HelpCommand
{

    public function help(): void
    {

        echo "help : affiche cette aide" . PHP_EOL . PHP_EOL . "list : liste les contacts" . PHP_EOL . PHP_EOL . "create [name], [email], [phone number] : crée un contact" . PHP_EOL . PHP_EOL . "delete [id] : supprime un contact"  . PHP_EOL . PHP_EOL . "quit : quitte le programme" . PHP_EOL;
    }
}
