<?php

namespace App\Http\Controllers\Api\Category;

use App\Http\Controllers\Controller;
use App\Http\Resources\Category\CategoriesPopularWithArticlesNewResource;
use App\Services\Api\CategoryService;
use Illuminate\Http\Request;

class CategoriesPopularWithArticlesNewController extends Controller
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

    public function __invoke()
    {
        $categoriesWithArticles = $this->categoryService->getCategoriesPopularWithArticlesNew();

        return new CategoriesPopularWithArticlesNewResource($categoriesWithArticles);
    }
}
