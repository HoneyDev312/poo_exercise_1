<?php

declare(strict_types=1);

namespace App\Entity;

class Contact
{
    public ?int $id;
    public string $name;
    public string $email;
    public string $phone_number;

    public function __construct(?int $id = null, string $name = "", string $email = "", string $phone_number = "")
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->phone_number = $phone_number;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setPhoneNumber(string $phone_number): void
    {
        $this->phone_number = $phone_number;
    }

    public function getPhoneNumber(): string
    {
        return $this->phone_number;
    }

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
