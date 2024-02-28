<?php

namespace App\Services\Api;

use App\Services\BaseService;
use App\Models\Article;

class ArticleService extends BaseService
{
    /**
     * The limit for the number of popular articles to retrieve.
     * 
     * @var int
     */
    const ARTICLE_POPULAR_LIMIT = 8;

    /**
     * The limit for the number of new articles to retrieve.
     * 
     * @var int
     */
    const ARTICLE_NEW_LIMIT = 10;

    /**
     * The status code indicating that an article is public or published.
     * 
     * @var int
     */
    const ARTICLE_PUBLIC_STATUS = 2;

    /**
     * Constructor for ArticleService class.
     *
     * @param Article $model The Article model instance.
     */
    public function __construct(Article $model)
    {
        $this->model = $model;
    }

    /**
     * Get a collection of popular articles.
     *
     * @return \Illuminate\Database\Eloquent\Collection The collection of popular articles.
     */
    public function getArticlesPopular()
    {
        return $this->model->limit(self::ARTICLE_POPULAR_LIMIT)->get();
    }

    /**
     * Get a collection of new articles.
     *
     * @return \Illuminate\Database\Eloquent\Collection The collection of new articles.
     */
    public function getArticlesNew()
    {
        return $this->model->where('status', self::ARTICLE_PUBLIC_STATUS)->orderBy('publication_date', 'DESC')->limit(self::ARTICLE_NEW_LIMIT)->get();
    }


    /**
     * Get details of a specific article based on its slug.
     *
     * @param string $articleSlug The slug of the article.
     * @return \Illuminate\Database\Eloquent\Model The article details.
     */
    public function getArticleDetail($articleSlug)
    {
        return $this->model->where('status', self::ARTICLE_PUBLIC_STATUS)->where('article_slug', $articleSlug)->firstOrFail();
    }

    /**
     * Get a paginated collection of articles based on a category slug.
     *
     * @param string $categorySlug The slug of the category.
     * @return \Illuminate\Pagination\LengthAwarePaginator The paginated collection of articles with the specified category.
     */
    public function getArticlesByCategory($categorySlug)
    {
        return $this->model->with('category')
            ->whereHas('category', function ($query) use ($categorySlug) {
                $query->where('category_slug', $categorySlug);
            })
            ->where('status', self::ARTICLE_PUBLIC_STATUS)
            ->orderByDesc('publication_date')
            ->paginate(20);
    }
}
