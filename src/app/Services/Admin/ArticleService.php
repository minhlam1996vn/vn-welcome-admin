<?php

namespace App\Services\Admin;

use App\Services\BaseService;
use App\Models\Article;

class ArticleService extends BaseService
{
    public function __construct(Article $model)
    {
        $this->model = $model;
    }

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
