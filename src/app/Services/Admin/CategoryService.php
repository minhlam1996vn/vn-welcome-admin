<?php

namespace App\Services\Admin;

use App\Services\BaseService;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class CategoryService extends BaseService
{
    public function __construct(Category $model)
    {
        $this->model = $model;
    }

    public function getCategory($categoryId)
    {
        return $this->model->findOrFail($categoryId);
    }


    public function updateCategory($categoryId, $inputs)
    {
        return $this->model->where('id', $categoryId)->update($inputs);
    }

    public function destroyCategory($categoryId)
    {
        return $this->model->destroy($categoryId);
    }

    public function getAllCategories()
    {
        return $this->model->all();
    }

    public function getCategories($params)
    {
        return $this->model->query()
            ->when(isset($params['category_name']), function ($query) use ($params) {
                $query->where('category_name', 'like', '%' . $params['category_name'] . '%');
            })
            ->orderBy('category_order')
            ->get();
    }

    public function updateSortCategories($sortValue)
    {
        foreach ($sortValue as $sort => $value) {
            $this->model->where('id', $value['id'])->update(['category_order' => $sort + 1]);
        }
    }
}
