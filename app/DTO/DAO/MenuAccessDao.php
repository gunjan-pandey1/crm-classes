<?php
namespace App\DTO\DAO;

use App\Repository\MenuAccessRepository;

class MenuAccessDao
{
    private ?string $name;
    private ?string $slug;
    private ?string $icon;
    private MenuAccessRepository $menuAccessRepository;

    public function __construct(MenuAccessRepository $menuAccessRepository)
    {
        $this->menuAccessRepository = $menuAccessRepository;
        $this->name = null;
        $this->slug = null;
        $this->icon = null;
    }

    public function toArray(): array
    {
        $collection = [];

        if (isset($this->name)) {
            $collection['name'] = $this->name;
        }
        if (isset($this->slug)) {
            $collection['slug'] = $this->slug;
        }
        if (isset($this->icon)) {
            $collection['icon'] = $this->icon;
        }

        return $collection;
    }

    public function getMenuList(): array
    {
        $menuList = $this->menuAccessRepository->getMenuList();
        return $menuList->map(function ($menu) {
            $dao = new self($this->menuAccessRepository);
            $dao->setName($menu->model_name)
                ->setSlug($menu->model_slug)
                ->setIcon($menu->model_icon);
            return $dao->toArray();
        })->toArray();
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(?string $slug): self
    {
        $this->slug = $slug;
        return $this;
    }

    public function getIcon(): ?string
    {
        return $this->icon;
    }

    public function setIcon(?string $icon): self
    {
        $this->icon = $icon;
        return $this;
    }
}