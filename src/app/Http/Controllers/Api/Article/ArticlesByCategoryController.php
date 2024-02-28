<?php

namespace App\Http\Controllers\Api\Article;

use App\Http\Controllers\Controller;
use App\Http\Resources\Article\ArticlesByCategoryResource;
use App\Services\Api\ArticleService;

class ArticlesByCategoryController extends Controller
{
    /**
     * The article service instance.
     *
     * @var ArticleService
     */
    protected $articleService;

    /**
     * Constructor for ArticleController class.
     *
     * @param ArticleService $articleService The instance of the article service.
     */
    public function __construct(ArticleService $articleService)
    {
        $this->articleService = $articleService;
    }

    /**
     * Retrieve a paginated collection of articles based on a category slug.
     *
     * @param string $categorySlug The slug of the category.
     * @return \App\Http\Resources\Article\ArticlesByCategoryResource The resource for articles in a specific category.
     */
    public function __invoke($categorySlug)
    {
        $articles = $this->articleService->getArticlesByCategory($categorySlug);

        return new ArticlesByCategoryResource($articles);
    }
}
