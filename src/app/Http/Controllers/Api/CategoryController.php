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
     * @param CategoryService $categoryService The category service instance.
     */
    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function categoriesParent()
    {
        $categories = $this->categoryService->getCategoriesParent();

        return new CategoriesParentResource($categories);
    }
}
