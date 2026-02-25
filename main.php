<?php

declare(strict_types=1);

spl_autoload_register(static function (string $fqcn) {
    $path = str_replace('\\', '/', $fqcn) . '.php';

    if (file_exists($path)) {
        require_once $path;
    }
});

use App\Repository\ContactManager;

while (true) {
    $line = trim(readline("Entrez votre commande : "));
    echo PHP_EOL;
    if ($line === "list") {
        $contacts = new ContactManager()->findAll();

        foreach ($contacts as $contact) {
            echo $contact->toString();
        }
        break;
    } else {
        echo "cette commande n'existe pas  : $line\n";
    }
}
