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
}
