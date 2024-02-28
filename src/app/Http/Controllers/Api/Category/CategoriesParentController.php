<?php

namespace App\Http\Controllers\Api\Category;

use App\Http\Controllers\Controller;
use App\Http\Resources\Category\CategoriesParentResource;
use App\Services\Api\CategoryService;

class CategoriesParentController extends Controller
{
    /**
     * The category service instance.
     *
     * @var CategoryService
     */
    protected $categoryService;

    /**
     * Constructor for ArticleController class.
     *
     * @param CategoryService $categoryService The instance of the category service.
     */
    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    /**
     * Retrieve all top-level (parent) categories.
     *
     * @return \App\Http\Resources\Category\CategoriesParentResource The resource for top-level categories.
     */
    public function __invoke()
    {
        $categories = $this->categoryService->getCategoriesParent();

        return new CategoriesParentResource($categories);
    }
}
