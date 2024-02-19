<?php

namespace App\Services\Admin;

use App\Services\BaseService;
use App\Models\Article;
use Illuminate\Support\Facades\Storage;

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
     * Get a specific article by its ID.
     *
     * @param int $articleId The ID of the article.
     * @return mixed The retrieved article.
     */
    public function getArticle($articleId)
    {
        return $this->model->findOrFail($articleId);
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
            ->orderBy('created_at', 'DESC')
            ->paginate($limit)
            ->withQueryString();
    }

    /**
     * Create a new article.
     *
     * @param array $inputs The input data for creating the article.
     * @return mixed The created article.
     */
    public function createArticle($inputs)
    {
        return $this->model->create($inputs);
    }

    public function updateArticle($articleId, $articleUpdate)
    {
        return $this->model->where('id', $articleId)->update($articleUpdate);
    }

    /**
     * Uploads the thumbnail for an article and returns the URL.
     *
     * @param \Illuminate\Http\UploadedFile $fileUpload The uploaded file for the article thumbnail.
     * @return string The URL of the uploaded article thumbnail.
     */
    public function uploadThumbnailArticle($fileUpload)
    {
        $path = Storage::disk()->put('articles', $fileUpload);
        $url = Storage::url($path);

        return $url;
    }
}
