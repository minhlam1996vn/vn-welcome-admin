<?php

namespace App\Services\Admin;

use App\Services\BaseService;
use App\Models\Category;
use Illuminate\Support\Str;
use Exception;
use Illuminate\Support\Facades\Log;

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

    public function createCategory($inputs)
    {
        $inputs['category_slug'] = Str::slug($inputs['category_name']) ?? '-';

        return $this->model->create($inputs);
    }

    public function updateCategory($categoryId, $categoryUpdate)
    {
        return $this->model->where('id', $categoryId)->update($categoryUpdate);
    }

    public function destroyCategory($categoryId)
    {
        return $this->model->destroy($categoryId);
    }

    public function getAllCategoriesParent()
    {
        return $this->model->whereNull('parent_id')->orderBy('category_order')->get();
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

    public function updateSortCategories($sortValueArray)
    {
        try {
            foreach ($sortValueArray as $sort => $categoryInfo) {
                $this->updateCategory($categoryInfo['id'], ['category_order' => $sort + 1]);

                if ($categoryInfo['children']) {
                    foreach ($categoryInfo['children'] as $sort => $categoryChildrenInfo) {
                        $this->updateCategory($categoryChildrenInfo['id'], ['category_order' => $sort + 1]);
                    }
                }
            }

            return true;
        } catch (Exception $e) {
            Log::error('Error update sort categories: ' . $e->getMessage());

            return false;
        }
    }
}
