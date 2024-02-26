<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Category\CategoriesParentResource;
use App\Services\Api\CategoryService;

class CategoryController extends Controller
{
    /**
     * The category service instance.
     *
     * @var CategoryService
     */
    protected $categoryService;

    /**
     * Constructor for CategoryController class.
     *
     * @param CategoryService $categoryService The instance of the category service.
     */
    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    /**
     * Get top-level (parent) categories.
     *
     * @return CategoriesParentResource The resource collection of top-level categories.
     */
    public function categoriesParent()
    {
        $categories = $this->categoryService->getCategoriesParent();

        return new CategoriesParentResource($categories);
    }
}
