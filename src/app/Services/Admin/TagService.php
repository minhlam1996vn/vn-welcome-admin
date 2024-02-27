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

    /**
     * Get tags based on provided parameters.
     *
     * @param array $params The parameters for filtering tags.
     * @return mixed The paginated collection of tags.
     */
    public function getTags($params)
    {
        $limit = $params['limit'] ?? config('common.pagination.limit');

        $tags = $this->model->query()
            ->when(isset($params['tag_name']), function ($query) use ($params) {
                $query->where('tag_name', 'like', '%' . $params['tag_name'] . '%');
            })
            ->orderBy('created_at', 'DESC')->paginate($limit)->withQueryString();

        $tags->load('articles');

        return $tags;
    }

    /**
     * Get a specific tag by its ID.
     *
     * @param int $tagId The ID of the tag to be retrieved.
     * @return \Illuminate\Database\Eloquent\Model The retrieved tag.
     */
    public function getTag($tagId)
    {
        return $this->model->findOrFail($tagId);
    }

    /**
     * Create a new tag.
     *
     * @param array $tagCreate The data for creating the tag.
     * @return \Illuminate\Database\Eloquent\Model The created tag.
     */
    public function createTag($tagCreate)
    {
        return $this->model->create($tagCreate);
    }

    /**
     * Update an existing tag.
     *
     * @param int $tagId The ID of the tag to be updated.
     * @param array $tagUpdate The data for updating the tag.
     * @return bool Whether the update was successful.
     */
    public function updateTag($tagId, $tagUpdate)
    {
        return $this->model->where('id', $tagId)->update($tagUpdate);
    }

    /**
     * Delete a tag.
     *
     * @param int $tagId The ID of the tag to be deleted.
     * @return int The number of deleted records.
     */
    public function destroyTag($tagId)
    {
        return $this->model->destroy($tagId);
    }
}
