<?php

namespace App\Services\Admin;

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
     * Get paginated articles based on specified parameters.
     *
     * @param array $params The parameters for filtering articles.
     * @return mixed The paginated collection of filtered articles.
     */
    public function getArticles($params)
    {
        $limit = $params['limit'] ?? config('common.pagination.limit');

        return $this->model->query()
            ->when(isset($params['category_id']), function ($query) use ($params) {
                $query->where('category_id', $params['category_id']);
            })
            ->when(isset($params['article_title']), function ($query) use ($params) {
                $query->where('article_title', 'like', '%' . $params['article_title'] . '%');
            })
            ->paginate($limit)
            ->withQueryString();
    }
}
