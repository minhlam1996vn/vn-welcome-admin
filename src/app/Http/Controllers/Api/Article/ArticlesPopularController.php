<?php

namespace App\Http\Controllers\Api\Article;

use App\Http\Controllers\Controller;
use App\Http\Resources\Article\ArticlesPopularResource;
use App\Services\Api\ArticleService;

class ArticlesPopularController extends Controller
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
     * Retrieve a collection of popular articles.
     *
     * @return \App\Http\Resources\Article\ArticlesPopularResource The resource for popular articles.
     */
    public function __invoke()
    {
        $articlesPopular = $this->articleService->getArticlesPopular();

        return new ArticlesPopularResource($articlesPopular);
    }
}
