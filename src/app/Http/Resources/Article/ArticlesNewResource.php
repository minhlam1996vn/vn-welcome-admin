<?php

namespace App\Http\Resources\Article;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\Storage;

class ArticlesNewResource extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return $this->collection->map(function ($item) {
            return [
                "id" => $item->id,
                "article_title" => $item->article_title,
                "article_slug" => $item->article_slug,
                "article_description" => $item->article_description,
                "article_thumbnail" => Storage::url($item->article_thumbnail),
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
