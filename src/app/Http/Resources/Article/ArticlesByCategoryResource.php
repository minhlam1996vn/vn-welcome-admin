<?php

namespace App\Http\Resources\Article;

use App\Http\Resources\BaseResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArticlesByCategoryResource extends BaseResource
{
    /**
     * The "articles" wrapper that should be applied.
     *
     * @var string|null
     */
    public static $wrap = 'articles';

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return $this->collection->map(function ($item) {
            return [
                "id" => $item->id,
                "article_title" => $item->article_title,
                "article_slug" => $item->article_slug,
                "article_description" => $item->article_description,
                "article_thumbnail" => $item->article_thumbnail ? Storage::url($item->article_thumbnail) : 'https://placehold.jp/1280x720.png',
                "category" => [
                    "id" => $item->category->id,
                    "category_name" => $item->category->category_name,
                    "category_slug" => $item->category->category_slug,
                ],
            ];
        })->toArray();
    }
}
