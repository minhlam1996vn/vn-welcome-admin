<?php

namespace App\Services\Api;

use App\Services\BaseService;
use App\Models\Category;

class CategoryService extends BaseService
{
    /**
     * Constructor for CategoryService class.
     *
     * @param Category $model The Category model instance.
     */
    public function __construct(Category $model)
    {
        $this->model = $model;
    }

    /**
     * Get all top-level (parent) categories.
     *
     * @return mixed The collection of top-level categories.
     */
    public function getCategoriesParent()
    {
        return $this->model->whereNull('parent_id')->orderBy('category_order')->get();
    }
}
