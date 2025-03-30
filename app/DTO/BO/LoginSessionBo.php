<?php

namespace App\DTO\BO;

use Exception;
use App\Services\Common\BetterstackLoggerService;

class LoginSessionBo
{
    private string $name = '';
    private string $email = '';
    private bool $isAuthenticated = false;
    private ?string $rememberToken = null;
    private ?string $emailVerifiedAt = null;
    private array $fullAccessList = [];
    private array $moduleAccessList = [];
    private array $modules = [];
    private array $sideBarMenu = [];


    public function getName(): string { return $this->name; }
    public function getEmail(): string { return $this->email; }
    public function isAuthenticated(): bool { return $this->isAuthenticated; }
    public function getRememberToken(): ?string { return $this->rememberToken; }
    public function getEmailVerifiedAt(): ?string { return $this->emailVerifiedAt; }
    public function getModules(): array { return $this->modules; }
    public function getFullAccessList(): array { return $this->fullAccessList; }
    public function getModuleAccessList(): array { return $this->moduleAccessList; }
    public function getSideBarMenu(): array { return $this->sideBarMenu; }


    public function setUser($user): void {
        if (!$user) {
            $this->logError('Attempt to set null user data');
            throw new Exception('User data is required');
        }
        $this->updateUserData($user);
    }

    private function updateUserData($user): void {
        $this->name = $user->name;
        $this->email = $user->email;
        $this->isAuthenticated = true;
        $this->rememberToken = $user->remember_token;
        $this->emailVerifiedAt = $user->email_verified_at;
    }

    public function setModules($modules): void {
        if (!$modules) {
            $this->logError('Attempt to set null module data');
            throw new Exception('Module data is required');
        }
        $this->modules = $modules->toArray();
    }

    public function setFullAccessList(array $fullAccessList): void {
        $this->fullAccessList = $fullAccessList;
    }

    public function setModuleAccessList(array $moduleAccessList): void {
        $this->moduleAccessList = $moduleAccessList;
    }

    public function setSideBarMenu($menu): void {
        if (!$menu) {
            $this->logError('Attempt to set null sidebar menu data');
            throw new Exception('Sidebar menu data is required');
        }
        $this->sideBarMenu = $menu;
    }

    public function toArray(): array {
        $data = [
            'user' => [
                'name' => $this->name,
                'email' => $this->email,
                'isAuthenticated' => $this->isAuthenticated,
                'rememberToken' => $this->rememberToken,
                'emailVerifiedAt' => $this->emailVerifiedAt
            ],
            'modules' => $this->modules,
            'fullAccessList' => $this->fullAccessList,
            'moduleAccessList' => $this->moduleAccessList,
            'sideBarMenu' => $this->sideBarMenu
        ];
        $this->logInfo('LoginSessionBo data converted to array', $data);        
        return $data;
    }

    public function getUserDetails(): array {
        return $this->toArray();
    }
    
    private function getUserContext(): array {
        return [
            'email' => $this->email,
            'username' => $this->name
        ];
    }
    
    private function logInfo(string $message, array $context = []): void {
        BetterstackLoggerService::info($message, $context, $this->getUserContext());
    }
    
    private function logError(string $message, array $context = []): void {
        BetterstackLoggerService::error($message, $context, $this->getUserContext());
    }
}