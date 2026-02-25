<?php

declare(strict_types=1);

require_once('DBConnect.php');
require_once('ContactManager.php');
require_once('Contact.php');

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
