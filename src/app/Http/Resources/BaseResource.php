<?php

namespace App\Http\Resources;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class BaseResource extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return parent::toArray($request);
    }

    public function withResponse(Request $request, JsonResponse $response)
    {
        $data = $response->getData(true);

        $pagination = [
            "current_page" => $this->currentPage(),
            "last_page" => $this->lastPage(),
            "per_page" =>  $this->perPage(),
            "total" => $this->total(),
        ] ?? null;

        $modifiedData = [
            static::$wrap ?? "data" => $data[static::$wrap] ?? $data["data"],
            "pager" => $pagination,
        ];

        $response->setData($modifiedData);
    }
}
