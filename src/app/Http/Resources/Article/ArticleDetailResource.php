<?php

namespace App\Http\Resources\Article;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class ArticleDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $category = $this->category;

        return [
            "id" => $this->id,
            "article_title" => $this->article_title,
            "article_slug" => $this->article_slug,
            "article_description" => $this->article_description,
            "article_keywords" => $this->article_keywords,
            "article_content" => $this->article_content,
            "article_thumbnail" => $this->article_thumbnail ? Storage::url($this->article_thumbnail) : 'https://placehold.jp/1280x720.png',
            "publication_date" => $this->publication_date,
            "category" => [
                "id" => $category->id,
                "category_name" => $category->category_name,
                "category_slug" => $category->category_slug,
            ],
            "tags" => $this->tags->map(function ($tag) {
                return [
                    "id" => $tag->id,
                    "tag_name" => $tag->tag_name,
                    "tag_slug" => $tag->tag_slug,
                ];
            })
        ];
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
