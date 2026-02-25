<?php

namespace App\Command;

use App\Repository\ContactManager;

class ListContacts
{
    public function __construct(private ContactManager $contactManager) {}

    public function execute(): void
    {
        $contacts = $this->contactManager->findAll();

        foreach ($contacts as $contact) {
            echo $contact->toString();
        }
    }
}
