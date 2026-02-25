<?php

namespace App\Cli;

use App\Repository\ContactManager;

class Command
{
    public function __construct(private ContactManager $contactManager) {}

    public function list(): void
    {
        $contacts = $this->contactManager->findAll();

        foreach ($contacts as $contact) {
            echo $contact->toString();
        }
    }
}
