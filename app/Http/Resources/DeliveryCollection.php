<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class DeliveryCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => $this->collection->map(function($data) {
                return [
                    "id"=> $data->id,
                    "name"=> $data->name,
                    "cost"=> $data->cost,
                    "time"=> $data->time,
                    "info"=> $data->info,
                    "status"=> $data->status,
                ];
            })
        ];
    }

    public function with($request)
    {
        return [
            'success' => true,
            'status' => 200
        ];
    }
}
