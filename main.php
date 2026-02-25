<?php

declare(strict_types=1);

require_once('DBConnect.php');
require_once('ContactManager.php');
require_once('Contact.php');

while (true) {
    $line = readline("Entrez votre commande : ");
    if ($line === "list") {
        echo "Affichage de la list";
        $manager = new ContactManager;
        $test =  $manager->findAll();
        var_dump($test);
        $contact = new Contact;
        $test2 =  $contact->toString();
        var_dump($test2);
        return;
    } else {
        echo "Vous avez saisi : $line\n";
    }
}
