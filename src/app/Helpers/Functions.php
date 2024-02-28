<?php

/**
 * Extract and modify query parameters from the current request's query string.
 *
 * @return string The modified query string.
 */
function getQueryStringCustom()
{
    $queryString = request()->getQueryString();
    parse_str($queryString, $queryParams);
    unset($queryParams['limit']);
    unset($queryParams['page']);
    $queryParams = array_filter($queryParams, function ($value) {
        return $value !== null && $value !== '';
    });

    return http_build_query($queryParams);
}

/**
 * Recursively retrieve categories and their details.
 *
 * @param array   $categories Array of category items.
 * @param int     $parent_id  Parent ID to start from (default: 0).
 * @return array  Array of categories with details.
 */
function getCategories($categories, $parent_id = 0)
{
    $result = [];

    foreach ($categories as $key => $item) {
        if ($item['parent_id'] == $parent_id) {
            $category = [
                'id' => $item['id'],
                'category_name' => $item['category_name'],
                'article_count' => $item->articles()->count(),
                'category_children_count' => $item->childCategories()->count(),
            ];

            unset($categories[$key]);

            $childCategories = getCategories($categories, $item['id']);
            if (!empty($childCategories)) {
                $category['children'] = $childCategories;
            }

            $result[] = $category;
        }
    }

    return $result;
}

/**
 * Show categories recursively in HTML <option> format.
 *
 * @param array   $categories Array of category items.
 * @param int     $parent_id  Parent ID to start from (default: 0).
 * @param string  $char       Prefix string for subcategories (default: null).
 * @param int $categoryId The ID of the currently selected category (default: null).
 * @return void
 */
function showCategories($categories, $parent_id = 0, $char = null, $categoryId = null)
{
    foreach ($categories as $key => $item) {
        if ($item['parent_id'] == $parent_id) {
            $isSelected = $categoryId == $item->id ? 'selected' : '';

            echo "<option $isSelected value=\"{$item->id}\">$char{$item->category_name}</option>";

            unset($categories[$key]);

            showCategories($categories, $item['id'], $char . '|--- ', $categoryId);
        }
    }
}
