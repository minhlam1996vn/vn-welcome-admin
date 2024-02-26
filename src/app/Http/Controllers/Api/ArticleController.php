<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Article\ArticlesNewResource;
use App\Http\Resources\Article\ArticlesPopularResource;
use App\Services\Api\ArticleService;

class ArticleController extends Controller
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
     * Get a collection of popular articles.
     *
     * @return ArticlesPopularResource The resource collection of popular articles.
     */
    public function articlesPopular()
    {
        $articlesPopular = $this->articleService->getArticlesPopular();

        return new ArticlesPopularResource($articlesPopular);
    }

    /**
     * Get a collection of new articles.
     *
     * @return ArticlesNewResource The resource collection of new articles.
     */
    public function articlesNew()
    {
        $articlesNew = $this->articleService->getArticlesNew();

        return new ArticlesNewResource($articlesNew);
    }
}
