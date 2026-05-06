<?php

declare(strict_types=1);

final class UpdateUserRequest
{
    private string $id;
    private string $name;
    private string $email;
    private ?string $password;
    private string $role;
    private string $status;

    public function __construct(array $data)
    {
        $this->id       = (string)($data['id'] ?? '');
        $this->name     = (string)($data['name'] ?? '');
        $this->email    = (string)($data['email'] ?? '');
        $this->password = !empty($data['password']) ? (string)$data['password'] : null;
        $this->role     = (string)($data['role'] ?? '');
        $this->status   = (string)($data['status'] ?? '');
    }

    public function getId(): string { return $this->id; }
    public function getName(): string { return $this->name; }
    public function getEmail(): string { return $this->email; }
    public function getPassword(): ?string { return $this->password; }
    public function getRole(): string { return $this->role; }
    public function getStatus(): string { return $this->status; }
}
