<?php

namespace App\Services\Api;

use App\Services\BaseService;
use App\Models\Article;

class ArticleService extends BaseService
{
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
        return $this->model->limit(8)->get();
    }

    /**
     * Get a collection of new articles.
     *
     * @return \Illuminate\Database\Eloquent\Collection The collection of new articles.
     */
    public function getArticlesNew()
    {
        return $this->model->where('status', 2)->orderBy('publication_date', 'DESC')->limit(10)->get();
    }
}
