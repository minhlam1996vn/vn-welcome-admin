<?php

/**
 * Get query string custom
 *
 * @return string
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

function getCategories($categories, $parent_id = 0, $char = '')
{
    $result = [];

    foreach ($categories as $key => $item) {
        if ($item['parent_id'] == $parent_id) {
            $category = [
                'id' => $item['id'],
                'category_name' => $item['category_name'],
                'article_count' => $item->articles->count(),
                'category_children_count' => $item->childCategories->count(),
                // 'category_name' => $char . $item['category_name']
            ];

            $childCategories = getCategories($categories, $item['id'], $char . '|---');
            if (!empty($childCategories)) {
                $category['children'] = $childCategories;
            }

            $result[] = $category;
            unset($categories[$key]);
        }
    }

    return $result;
}
