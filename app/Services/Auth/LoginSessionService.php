<?php

namespace App\Services\Auth;

use App\Constants\CommonConstant;
use Exception;
use App\DTO\BO\LoginSessionBo;
use App\Services\Auth\JWTService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Repository\ModelAccessRepository;
use Illuminate\Support\Collection;

class LoginSessionService
{
    private const PERMISSIONS = [
        CommonConstant::ACTION_VIEW,
    ];

    public function __construct(
        private readonly LoginSessionBo $loginSessionBo,
        private readonly JWTService $jwtService,
        private readonly ModelAccessRepository $modelAccessRepository
    ) {}

    public function loginSessionProcess(): bool
    {
        try {
            $this->initializeUserAndModules();
            $sessionData = $this->prepareSessionData();
            session()->put('AllUserDetails', $sessionData);
            
            return true;
        } catch (Exception $e) {
            throw new Exception("Failed to process login session: {$e->getMessage()}");
        }
    }

    private function initializeUserAndModules(): void
    {
        $this->loginSessionBo->setUser(Auth::user());
        $modules = $this->modelAccessRepository->getModelList();
        $this->loginSessionBo->setModules($modules);
        $this->processAccessLists($modules);
        $this->loginSessionBo->setSideBarMenu($this->buildMenuAccessList());
    }

    private function prepareSessionData(): array
    {
        return [
            'token' => '',
            'user' => $this->loginSessionBo->getUserDetails(),
            'fullAccessList' => $this->loginSessionBo->getFullAccessList(),
            'moduleAccessList' => $this->loginSessionBo->getModuleAccessList(),
            'sideBarMenu' => $this->loginSessionBo->getSideBarMenu()
        ];
    }

    private function processAccessLists(array|Collection $modules): void
    {
        $this->setFullAccessList($modules);
        $this->setModuleAccessList($modules);
    }

    private function setFullAccessList(array|Collection $modules): void
    {
        $fullAccessList = collect($modules)->mapWithKeys(function ($module) {
            $modelName = strtolower($module['model_name']);
            return [$modelName => Gate::allows('full-access', $modelName)];
        });

        $this->loginSessionBo->setFullAccessList($fullAccessList->toArray());
    }

    private function setModuleAccessList(array|Collection $modules): void
    {
        $moduleAccessList = collect($modules)->mapWithKeys(function ($module) {
            $modelName = strtolower($module['model_name']);
            $permissions = collect(self::PERMISSIONS)->mapWithKeys(function ($permission) use ($modelName) {
                return [$permission => Gate::allows('module-access', [$modelName, $permission])];
            });
            
            return [$modelName => $permissions->toArray()];
        });

        $this->loginSessionBo->setModuleAccessList($moduleAccessList->toArray());
    }

    private function buildMenuAccessList(): array
    {
        $fullAccessList = $this->loginSessionBo->getFullAccessList();
        $moduleAccessList = $this->loginSessionBo->getModuleAccessList();
        
        return collect($this->loginSessionBo->getModules())
            ->filter(function ($module) use ($fullAccessList, $moduleAccessList) {
                $modelName = strtolower($module['model_name']);
                return $fullAccessList[$modelName] || 
                       ($moduleAccessList[$modelName]['view'] ?? false);
            })
            ->values()
            ->toArray();
    }
}