<?php

namespace App\Services\Admin;

use App\Services\BaseService;
use App\Models\Article;
use Illuminate\Database\QueryException;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
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
     * Create a new article with optional tags.
     *
     * @param array $inputs The input data for creating the article.
     * @param array|null $arrayTagId An array of tag IDs to associate with the article.
     * @return mixed The created article.
     */
    public function createArticle($inputs, $arrayTagId)
    {
        DB::beginTransaction();

        try {
            $article = $this->model->create($inputs);

            if ($article && $arrayTagId) {
                $article->tags()->attach($arrayTagId);
            }

            DB::commit();

            return $article;
        } catch (QueryException $e) {
            DB::rollback();
            throw ($e);

            return null;
        }
    }

    /**
     * Update an existing article with optional tags.
     *
     * @param int $articleId The ID of the article to be updated.
     * @param array $articleUpdate The input data for updating the article.
     * @param array|null $arrayTagId An array of tag IDs to associate with the updated article.
     * @return bool Whether the update was successful.
     */
    public function updateArticle($articleId, $articleUpdate, $arrayTagId)
    {
        DB::beginTransaction();

        try {
            $article = $this->model->find($articleId);

            if ($articleUpdate['article_thumbnail']) {
                Storage::disk()->delete($article->article_thumbnail);
            }

            $articleUpdateResponse = $this->model->where('id', $articleId)->update($articleUpdate);

            if (!$arrayTagId) {
                $article->tags()->detach();
            } elseif ($articleUpdateResponse && $arrayTagId) {
                $arrayTagIdOld = $article->tags->pluck('id')->toArray();
                $checkUpdateTagId = array_diff($arrayTagId, $arrayTagIdOld) === array_diff($arrayTagIdOld, $arrayTagId);

                if (!$checkUpdateTagId) {
                    $article->tags()->detach();
                    $article->tags()->attach($arrayTagId);
                }
            }

            DB::commit();

            return $articleUpdateResponse;
        } catch (QueryException $e) {
            DB::rollback();
            throw ($e);

            return false;
        }
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
        // $url = Storage::url($path);

        return $path;
    }
}
