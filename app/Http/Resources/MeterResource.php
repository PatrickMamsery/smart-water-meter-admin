<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MeterResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'customer' => $this->customer->name,
            'customer_id' => $this->customer_id,
            'meter_number' => $this->meter_number,
            'meter_type' => $this->meter_type,
            'meter_status' => $this->meter_status,
            'meter_location' => $this->meter_location,
        ];
    }
}
