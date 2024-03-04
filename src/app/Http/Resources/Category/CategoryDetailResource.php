<?php

namespace App\Http\Resources\Category;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "category_name" => $this->category_name,
            "category_slug" => $this->category_slug,
            "category_keywords" => $this->category_keywords,
            "category_description" => $this->category_description,
            "categoriesChild" => $this->childCategories->map(function ($item) {
                return [
                    "id" => $item->id,
                    "category_name" => $item->category_name,
                    "category_slug" => $item->category_slug,
                ];
            }),
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
