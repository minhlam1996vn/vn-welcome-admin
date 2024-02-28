<?php

namespace App\Http\Controllers\Api\Category;

use App\Http\Controllers\Controller;
use App\Http\Resources\Category\CategoryDetailResource;
use App\Services\Api\CategoryService;

class CategoryDetailController extends Controller
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
     * Retrieve details of a specific category.
     *
     * @param string $categorySlug The slug of the category.
     * @return \App\Http\Resources\Category\CategoryDetailResource The category detail resource.
     */
    public function __invoke($categorySlug)
    {
        $categoryDetail = $this->categoryService->getCategory($categorySlug);

        return new CategoryDetailResource($categoryDetail);
    }
}
