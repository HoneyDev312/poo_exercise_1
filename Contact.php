<?php

declare(strict_types=1);

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

    public function getId(): int
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

    public function setEmail(string $name): void
    {
        $this->name = $name;
    }

    public function getEmail(): string
    {
        return $this->name;
    }

    public function setPhoneNumber(string $name): void
    {
        $this->name = $name;
    }

    public function getPhoneNumber(): string
    {
        return $this->name;
    }

    public function toString(): string
    {
        return sprintf(
            '%s, %s, %s, %s',
            $this->id ?? 'null',
            $this->name,
            $this->email,
            $this->phone_number
        );
    }
}
