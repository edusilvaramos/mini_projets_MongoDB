<?php

namespace App\Model;

class User
{
    public ?string $id = null;
    public string $firstName;
    public string $lastName;
    public string $username;
    public string $email;
    public string $passwordHash;
    public string $role;
    public ?string $conectedAt;
    public bool $isConnected;

    public function __construct(
        string $firstName,
        string $lastName,
        string $username,
        string $email,
        string $passwordHash,
        string $role = "ROLE_USER",
        ?string $conectedAt = null,
        bool $isConnected = false
    ) {
        $this->firstName   = $firstName;
        $this->lastName    = $lastName;
        $this->username    = $username;
        $this->email       = $email;
        $this->passwordHash = $passwordHash;
        $this->role        = $role;
        $this->conectedAt  = $conectedAt;
        $this->isConnected = $isConnected;
    }
}