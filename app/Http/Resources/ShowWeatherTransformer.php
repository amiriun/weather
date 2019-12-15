<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ShowWeatherTransformer extends JsonResource
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
                'hour' => $this->humanReadableHour($hour),
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

    /**
     * @param $hour
     * @return mixed
     */
    private function humanReadableHour($hour)
    {
        if($hour<10){
            return "0$hour:00";
        }

        return "$hour:00";
    }
}
