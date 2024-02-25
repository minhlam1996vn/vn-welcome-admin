<?php

namespace App\Services\Admin;

use App\Services\BaseService;
use App\Models\Article;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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
     * @param array $articleCreate The input data for creating the article.
     * @param array|null $tagId An array of tag IDs to associate with the article.
     * @param string|null $imageBase64 The base64-encoded image data for the article thumbnail.
     * @param string|null $mediaUse Comma-separated string of media filenames in use.
     * @return mixed The created article.
     * @throws QueryException
     */
    public function createArticle($articleCreate, $tagId, $imageBase64, $mediaUse)
    {
        DB::beginTransaction();

        try {
            if ($imageBase64) {
                $articleCreate['article_thumbnail'] = $this->uploadImageBase64($imageBase64);
            }

            if ($mediaUse) {
                $folderPath = 'medias/' . $articleCreate['uuid'];
                $this->deleteMediaNotUse($folderPath, $mediaUse);
            }

            $article = $this->model->create($articleCreate);

            if ($article && $tagId) {
                $article->tags()->attach($tagId);
            }

            DB::commit();

            return $article;
        } catch (QueryException $e) {
            DB::rollback();
            throw ($e);
        }
    }

    /**
     * Update an existing article with optional tags, thumbnail, and media files.
     *
     * @param int $articleId The ID of the article to be updated.
     * @param array $articleUpdate The input data for updating the article.
     * @param array|null $tagId An array of tag IDs to associate with the updated article.
     * @param \Illuminate\Http\UploadedFile|null $fileUpload The uploaded file for the article thumbnail.
     * @param string|null $mediaUse Comma-separated string of media filenames in use.
     * @return bool Whether the update was successful.
     * @throws QueryException
     */
    public function updateArticle($articleId, $articleUpdate, $tagId, $imageBase64, $mediaUse)
    {
        DB::beginTransaction();

        try {
            $article = $this->model->find($articleId);

            if ($imageBase64) {
                $articleUpdate['article_thumbnail'] = $this->uploadImageBase64($imageBase64);

                if ($article->article_thumbnail) {
                    Storage::delete($article->article_thumbnail);
                }
            }

            if ($mediaUse) {
                $folderPath = 'medias/' . $article->uuid;
                $this->deleteMediaNotUse($folderPath, $mediaUse);
            }

            $articleUpdateResponse = $this->model->where('id', $articleId)->update($articleUpdate);

            if (!$tagId) {
                $article->tags()->detach();
            } elseif ($articleUpdateResponse && $tagId) {
                $arrayTagIdOld = $article->tags->pluck('id')->toArray();
                $checkUpdateTagId = array_diff($tagId, $arrayTagIdOld) === array_diff($arrayTagIdOld, $tagId);

                if (!$checkUpdateTagId) {
                    $article->tags()->detach();
                    $article->tags()->attach($tagId);
                }
            }

            DB::commit();

            return $articleUpdateResponse;
        } catch (QueryException $e) {
            DB::rollback();
            throw ($e);
        }
    }

    /**
     * Uploads an image from base64 data and returns the file path.
     *
     * @param string $imageBase64 The base64-encoded image data.
     * @return string The file path of the uploaded image.
     */
    public function uploadImageBase64($imageBase64)
    {
        list($extension, $content) = explode(';', $imageBase64);
        $tmpExtension = explode('/', $extension);
        preg_match('/.([0-9]+) /', microtime(), $m);
        $fileName = sprintf('%s%s.%s', Str::uuid() . date('YmdHis'), $m[1], $tmpExtension[1]);
        $content = explode(',', $content)[1];
        $path = 'articles/' . $fileName;
        Storage::put($path, base64_decode($content));

        return $path;
    }

    /**
     * Delete unused media files from the specified folder.
     *
     * @param string $folderPath The folder path containing media files.
     * @param string $mediaUse Comma-separated string of media filenames in use.
     * @return void
     */
    public function deleteMediaNotUse($folderPath, $mediaUse)
    {
        $files = Storage::files($folderPath);
        $arrayImgPath = explode(',', $mediaUse);

        $uniqueFiles = array_diff(
            array_map('basename', $files),
            array_map('basename', $arrayImgPath)
        );

        if (!empty($uniqueFiles)) {
            foreach ($uniqueFiles as $file) {
                Storage::delete($folderPath . '/' . $file);
            }
        }
    }
}
