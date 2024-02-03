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
