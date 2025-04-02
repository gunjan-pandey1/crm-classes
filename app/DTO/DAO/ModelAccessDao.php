<?php
namespace App\DTO\DAO;

use App\Repository\ModelAccessRepository;
use App\Services\Common\BetterstackLoggerService;
use Exception;

class ModelAccessDao
{
    private const MODEL_FIELDS = [
        'name' => 'model_name',
        'slug' => 'model_slug',
        'icon' => 'model_icon'
    ];

    private ?string $name = null;
    private ?string $slug = null;
    private ?string $icon = null;
    private string $username = '';
    private string $email = '';
    private ModelAccessRepository $modelAccessRepository;

    public function __construct(ModelAccessRepository $modelAccessRepository)
    {
        $this->modelAccessRepository = $modelAccessRepository;
    }

    public function toArray(): array
    {
        try {
            $result = array_filter(
                array_combine(
                    array_values(self::MODEL_FIELDS),
                    [$this->name, $this->slug, $this->icon]
                )
            );
            
            $this->logInfo('Model data converted to array successfully', $result);
            return $result;
        } catch (Exception $e) {
            $this->logError('Failed to convert model data to array', ['error' => $e->getMessage()]);
            return [];
        }
    }

    public function getModelList(): array
    {
        try {
            $models = $this->modelAccessRepository->getModelList()
                ->map(fn($model) => array_combine(
                    array_values(self::MODEL_FIELDS),
                    [$model->model_name, $model->model_slug, $model->model_icon]
                ))
                ->toArray();
            
            $this->logInfo('Retrieved model list successfully', ['count' => count($models)]);
            return $models;
        } catch (Exception $e) {
            $this->logError('Failed to retrieve model list', ['error' => $e->getMessage()]);
            return [];
        }
    }

    // Getter and setter methods using PHP 8 syntax
    public function getName(): ?string { return $this->name; }
    public function setName(?string $name): self { $this->name = $name; return $this; }
    public function getSlug(): ?string { return $this->slug; }
    public function setSlug(?string $slug): self { $this->slug = $slug; return $this; }
    public function getIcon(): ?string { return $this->icon; }
    public function setIcon(?string $icon): self { $this->icon = $icon; return $this; }
    
    private function getUserContext(): array
    {
        return compact('email', 'username');
    }
    
    private function logInfo(string $message, array $context = []): void
    {
        BetterstackLoggerService::info($message, $context, $this->getUserContext());
    }
    
    private function logError(string $message, array $context = []): void
    {
        BetterstackLoggerService::error($message, $context, $this->getUserContext());
    }
}