<?php

namespace App\DTO\BO;

use Exception;

class LoginSessionBo
{
    private string $name;
    private string $email;
    private bool $isAuthenticated;
    private ?string $rememberToken;
    private ?string $emailVerifiedAt;
    private array $fullAccessList = [];
    private array $moduleAccessList = [];

    public function __construct(
        string $name,
        string $email,
        bool $isAuthenticated,
        ?string $rememberToken = null,
        ?string $emailVerifiedAt = null
    ) {
        $this->name = $name;
        $this->email = $email;
        $this->isAuthenticated = $isAuthenticated;
        $this->rememberToken = $rememberToken;
        $this->emailVerifiedAt = $emailVerifiedAt;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function isAuthenticated(): bool
    {
        return $this->isAuthenticated;
    }

    public function getRememberToken(): ?string
    {
        return $this->rememberToken;
    }

    public function getEmailVerifiedAt(): ?string
    {
        return $this->emailVerifiedAt;
    }

    public function setUser($user): void
    {
        if (!$user) {
            throw new Exception('User data is required');
        }

        $this->name = $user->name;
        $this->email = $user->email;
        $this->isAuthenticated = true;
        $this->rememberToken = $user->remember_token;
        $this->emailVerifiedAt = $user->email_verified_at;
    }

    public function setFullAccessList(array $fullAccessList): void
    {
        $this->fullAccessList = $fullAccessList;
    }

    public function getFullAccessList(): array
    {
        return $this->fullAccessList;
    }

    public function setModuleAccessList(array $moduleAccessList): void
    {
        $this->moduleAccessList = $moduleAccessList;
    }

    public function getModuleAccessList(): array
    {
        return $this->moduleAccessList;
    }

    public function getUserDetails(): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'isAuthenticated' => $this->isAuthenticated,
            'rememberToken' => $this->rememberToken,
            'emailVerifiedAt' => $this->emailVerifiedAt,
            'fullAccessList' => $this->fullAccessList,
            'moduleAccessList' => $this->moduleAccessList
        ];
    }
}