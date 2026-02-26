<?php

declare(strict_types=1);

namespace App\Entity;

class Contact
{
    public ?int $id;
    public string $name;
    public string $email;
    public string $phone_number;

    // Constructeur : crée un objet Contact et initialise ses propriétés
    public function __construct(?int $id = null, string $name = "", string $email = "", string $phone_number = "")
    {
        // Propriétés du contact (id null tant que le contact n'est pas enregistré en base
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->phone_number = $phone_number;
    }

    // Retourne l'id (ou null si non défini)
    public function getId(): ?int
    {
        return $this->id;
    }

    // Modifie le nom
    public function setName(string $name): void
    {
        $this->name = $name;
    }
    // Retourne le nom
    public function getName(): string
    {
        return $this->name;
    }
    // Modifie l'email
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }
    // Retourne l'email
    public function getEmail(): string
    {
        return $this->email;
    }
    // Modifie le numéro de téléphone
    public function setPhoneNumber(string $phone_number): void
    {
        $this->phone_number = $phone_number;
    }
    // Retourne le numéro de téléphone
    public function getPhoneNumber(): string
    {
        return $this->phone_number;
    }
    // Méthode magique : appelée automatiquement quand on affiche l'objet (ex: echo $contact)
    public function __toString(): string
    {
        return sprintf(
            '%s, %s, %s, %s%s%s',
            $this->id ?? 'null',
            $this->name,
            $this->email,
            $this->phone_number,
            PHP_EOL,
            PHP_EOL
        );
    }
}
