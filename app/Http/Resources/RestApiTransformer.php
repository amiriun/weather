<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RestApiTransformer extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $items = [];
        foreach ($this->resource as $hour => $temperature) {
            $items[] = [
                'hour' => $hour,
                'temperature' => $temperature,
            ];
        }

        return [
            'data' => $items,
            'meta' => [
                'status' => 200,
                'messages' => null,
            ],
        ];
    }
}
