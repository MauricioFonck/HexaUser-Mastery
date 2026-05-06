<?php

declare(strict_types=1);

final class CreateUserRequest
{
    private string $id;
    private string $name;
    private string $email;
    private string $password;
    private string $role;

    public function __construct(array $data)
    {
        $this->id       = (string)($data['id'] ?? '');
        $this->name     = (string)($data['name'] ?? '');
        $this->email    = (string)($data['email'] ?? '');
        $this->password = (string)($data['password'] ?? '');
        $this->role     = (string)($data['role'] ?? '');
    }

    public function getId(): string { return $this->id; }
    public function getName(): string { return $this->name; }
    public function getEmail(): string { return $this->email; }
    public function getPassword(): string { return $this->password; }
    public function getRole(): string { return $this->role; }
}
