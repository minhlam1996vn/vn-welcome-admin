<?php

namespace App\Http\Controllers\Api\Article;

use App\Http\Controllers\Controller;
use App\Http\Resources\Article\ArticleDetailResource;
use App\Services\Api\ArticleService;
use Illuminate\Http\Request;

class ArticleDetailController extends Controller
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
     * Retrieve details of a specific article based on its slug.
     *
     * @param string $articleSlug The slug of the article.
     * @return \App\Http\Resources\Article\ArticleDetailResource The resource for article details.
     */
    public function __invoke($articleSlug)
    {
        $articleDetail = $this->articleService->getArticleDetail($articleSlug);

        return new ArticleDetailResource($articleDetail);
    }
}
