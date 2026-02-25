<?php

declare(strict_types=1);

require_once('App/Repository/ContactManager.php');
require_once('App/Entity/Contact.php');

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
