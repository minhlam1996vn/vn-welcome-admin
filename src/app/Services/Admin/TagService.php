<?php

namespace App\Services\Admin;

use App\Services\BaseService;
use App\Models\Tag;

class TagService extends BaseService
{
    /**
     * Constructor for ArticleService class.
     *
     * @param Tag $model The Article model instance.
     */
    public function __construct(Tag $model)
    {
        $this->model = $model;
    }

    /**
     * Get all tags.
     *
     * @return mixed The collection of all tags.
     */
    public function getAllTags()
    {
        return $this->model->orderBy('created_at')->get();
    }

    public function getTags($params)
    {
        $limit = $params['limit'] ?? config('common.pagination.limit');

        return $this->model->query()
            ->when(isset($params['tag_name']), function ($query) use ($params) {
                $query->where('tag_name', 'like', '%' . $params['tag_name'] . '%');
            })
            ->orderBy('created_at', 'DESC')->paginate($limit)->withQueryString();
    }

    public function getTag($tagId)
    {
        return $this->model->findOrFail($tagId);
    }

    public function createTag($tagCreate)
    {
        return $this->model->create($tagCreate);
    }

    public function updateTag($tagId, $tagUpdate)
    {
        return $this->model->where('id', $tagId)->update($tagUpdate);
    }

    public function destroyTag($tagId)
    {
        return $this->model->destroy($tagId);
    }
}
