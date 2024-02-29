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
     * @return \Illuminate\Database\Eloquent\Collection The collection of top-level categories.
     */
    public function getCategoriesParent()
    {
        return $this->model->whereNull('parent_id')->orderBy('category_order')->get();
    }

    /**
     * Get top-level categories with their child categories and ordered by 'category_order'.
     *
     * @return \Illuminate\Database\Eloquent\Collection The collection of top-level categories with child categories.
     */
    public function getCategoriesPopularWithArticlesNew()
    {
        return $this->model->query()
            ->with(['childCategories' => function ($query) {
                $query->orderBy('category_order');
            }])
            ->whereNull('parent_id')->orderBy('category_order')->limit(4)->get();
    }

    /**
     * Get details of a specific category based on its slug.
     *
     * @param string $categorySlug The slug of the category.
     * @return \Illuminate\Database\Eloquent\Model The category details.
     */
    public function getCategory($categorySlug)
    {
        return $this->model->query()
            ->with(['childCategories' => function ($query) {
                $query->orderBy('category_order');
            }])->where('category_slug', $categorySlug)
            ->firstOrFail();
    }
}
