<?php

namespace App\Http\Resources\Category;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\Storage;

class CategoriesPopularWithArticlesNewResource extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return $this->collection->map(function ($item) {
            $articles = $item->articles()->where('status', 2)->orderByDesc('publication_date')->limit(7)->get();

            return [
                "id" => $item->id,
                "category_name" => $item->category_name,
                "category_slug" => $item->category_slug,
                "categoriesChild" => $item->childCategories->map(function ($item) {
                    return [
                        "id" => $item->id,
                        "category_name" => $item->category_name,
                        "category_slug" => $item->category_slug,
                    ];
                }),
                "articles" => $articles->map(function ($item) {
                    return [
                        "id" => $item->id,
                        "article_title" => $item->article_title,
                        "article_slug" => $item->article_slug,
                        "article_description" => $item->article_description,
                        "article_thumbnail" => $item->article_thumbnail ? Storage::url($item->article_thumbnail) : 'https://source.unsplash.com/random/1280x720?cryptocurrency&' . $item->id,
                        "category" => [
                            "id" => $item->category->id,
                            "category_name" => $item->category->category_name,
                            "category_slug" => $item->category->category_slug,
                        ],
                    ];
                }),
            ];
        })->toArray();
    }

    /**
     * Customize the outgoing response for the resource.
     *
     * @param Request $request The request instance.
     * @param JsonResponse $response The JSON response instance.
     * @return void
     */
    public function withResponse(Request $request, JsonResponse $response): void
    {
        $data = $response->getData(true);

        $response->setData($data["data"]);
    }
}
