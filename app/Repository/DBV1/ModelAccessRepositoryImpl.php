<?php
namespace App\Repository\DBV1;
use App\Repository\ModelAccessRepository;
use App\Models\CrmModels;
class ModelAccessRepositoryImpl implements ModelAccessRepository
{
    public function getModelList()
    {
        return CrmModels::select('model_name','model_slug','model_icon')->where('status', 1)->get();
    }
}