<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReportResource extends JsonResource
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
            'customer' => new CustomerResource($this->customer), // Assuming you have a CustomerResource class
            'quantity' => $this->quantity,
            'discount' => $this->discount,
            'total' => $this->total,
            'paid' => $this->paid,
        ];
    }
}
