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
        CommonConstant::ACTION_CREATE,
        CommonConstant::ACTION_EDIT,
        CommonConstant::ACTION_DELETE
    ];

    public function __construct(
        private readonly LoginSessionBo $loginSessionBo,
        private readonly JWTService $jwtService,
        private readonly ModelAccessRepository $modelAccessRepository
    ) {}

    public function loginSessionProcess(): void
    {
        try {
            $user = Auth::user();
            $this->loginSessionBo->setUser($user);
            
            $modules = $this->modelAccessRepository->getModelList();
            $this->processAccessLists($modules);
            
            $userDetails = $this->loginSessionBo->getUserDetails();
            $token = $this->jwtService->encryptFileBasedToken($userDetails);
            $sessionData = [
                'token' => $token,
                'user' => $userDetails,
                'fullAccessList' => $this->loginSessionBo->getFullAccessList(),
                'moduleAccessList' => $this->loginSessionBo->getModuleAccessList(),
                'sideBarMenu' => ''
            ];
            session()->put('AllUserDetails',$sessionData);
        } catch (Exception $e) {
            throw new Exception('Failed to process login session: ' . $e->getMessage());
        }
    }

    private function processAccessLists(array|Collection $modules): void
    {
        $this->setFullAccessList($modules);
        $this->setModuleAccessList($modules);
    }

    private function setFullAccessList(array|Collection $modules): void
    {
        $fullAccessList = collect($modules)->mapWithKeys(
            fn ($module) => [$module => Gate::allows('full-access', $module)]
        );

        $this->loginSessionBo->setFullAccessList($fullAccessList->toArray());
    }

    private function setModuleAccessList(array|Collection $modules): void
    {
        $moduleAccessList = collect($modules)->mapWithKeys(
            fn ($module) => [
                $module => collect(self::PERMISSIONS)->mapWithKeys(
                    fn ($permission) => [$permission => Gate::allows('module-access', [$module, $permission])]
                )->toArray()
            ]
        );

        $this->loginSessionBo->setModuleAccessList($moduleAccessList->toArray());
    }
}