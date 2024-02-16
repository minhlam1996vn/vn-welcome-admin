<?php

namespace App\Services\Admin;

use App\Services\BaseService;
use App\Models\Category;
use Illuminate\Support\Str;
use Exception;
use Illuminate\Support\Facades\Log;

class CategoryService extends BaseService
{
    /**
     * Constructor for CategoryService class.
     *
     * @param Category $model The Category model instance.
     */
    public function __construct(Category $model)
    {
        $this->model = $model;
    }

    /**
     * Get a specific category by its ID.
     *
     * @param int $categoryId The ID of the category.
     * @return mixed The retrieved category.
     */
    public function getCategory($categoryId)
    {
        return $this->model->findOrFail($categoryId);
    }

    /**
     * Create a new category.
     *
     * @param array $inputs The input data for creating the category.
     * @return mixed The created category.
     */
    public function createCategory($inputs)
    {
        $inputs['category_slug'] = Str::slug($inputs['category_name']) ?? '-';

        return $this->model->create($inputs);
    }

    /**
     * Update an existing category.
     *
     * @param int   $categoryId     The ID of the category to be updated.
     * @param array $categoryUpdate The updated data for the category.
     * @return mixed The result of the update operation.
     */
    public function updateCategory($categoryId, $categoryUpdate)
    {
        return $this->model->where('id', $categoryId)->update($categoryUpdate);
    }

    /**
     * Delete a category by its ID.
     *
     * @param int $categoryId The ID of the category to be deleted.
     * @return mixed The result of the deletion operation.
     */
    public function destroyCategory($categoryId)
    {
        return $this->model->destroy($categoryId);
    }

    /**
     * Get all top-level (parent) categories.
     *
     * @return mixed The collection of top-level categories.
     */
    public function getAllCategoriesParent()
    {
        return $this->model->whereNull('parent_id')->orderBy('category_order')->get();
    }

    /**
     * Get all categories.
     *
     * @return mixed The collection of all categories.
     */
    public function getAllCategories()
    {
        return $this->model->orderBy('category_order')->get();
    }

    /**
     * Get categories based on specified parameters.
     *
     * @param array $params The parameters for filtering categories.
     * @return mixed The collection of filtered categories.
     */
    public function getCategories($params)
    {
        return $this->model->query()
            ->when(isset($params['category_name']), function ($query) use ($params) {
                $query->where('category_name', 'like', '%' . $params['category_name'] . '%');
            })
            ->orderBy('category_order')
            ->get();
    }

    /**
     * Update the sorting order of categories.
     *
     * @param array $sortValueArray The array containing sorting information.
     * @return bool The success status of the update operation.
     */
    public function updateSortCategories($sortValueArray)
    {
        try {
            foreach ($sortValueArray as $sort => $categoryInfo) {
                $this->updateCategory($categoryInfo['id'], ['category_order' => $sort + 1]);

                if ($categoryInfo['children']) {
                    foreach ($categoryInfo['children'] as $sort => $categoryChildrenInfo) {
                        $this->updateCategory($categoryChildrenInfo['id'], ['category_order' => $sort + 1]);
                    }
                }
            }

            return true;
        } catch (Exception $e) {
            Log::error('Error update sort categories: ' . $e->getMessage());

            return false;
        }
    }
}
