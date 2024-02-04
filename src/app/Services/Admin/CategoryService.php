<?php

namespace App\Services\Admin;

use App\Services\BaseService;
use App\Models\Category;

class CategoryService extends BaseService
{
    public function __construct(Category $model)
    {
        $this->model = $model;
    }

    public function getAllCategories()
    {
        return $this->model->all();
    }

    public function getCategories($params)
    {
        $limit = $params['limit'] ?? config('common.pagination.limit');

        return $this->model->query()
            ->when(isset($params['category_name']), function ($query) use ($params) {
                $query->where('category_name', 'like', '%' . $params['category_name'] . '%');
            })
            ->paginate($limit)
            ->withQueryString();
    }
}
