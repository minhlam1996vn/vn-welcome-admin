<?php

namespace App\Http\Controllers\Api\Article;

use App\Http\Controllers\Controller;
use App\Http\Resources\Article\ArticlesNewResource;
use App\Services\Api\ArticleService;

class ArticlesNewController extends Controller
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

    public function __invoke()
    {
        $articlesNew = $this->articleService->getArticlesNew();

        return new ArticlesNewResource($articlesNew);
    }
}
