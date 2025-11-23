<?php

namespace App\Model;

class User
{
    public ?string $id = null;
    public string $firstName;
    public string $lastName;
    public string $userName;
    public string $email;
    public string $passwordHash;

    public function __construct(
        string $firstName,
        string $lastName,
        string $userName,
        string $email,
        string $passwordHash
    ) {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->userName = $userName;
        $this->email = $email;
        $this->passwordHash = $passwordHash;
    }

}