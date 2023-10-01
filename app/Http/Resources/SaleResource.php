<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SaleResource extends JsonResource
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
            'book' => new BookResource($this->book), // Assuming you have a BookResource class
            'customer' => new CustomerResource($this->customer), // Assuming you have a CustomerResource class
            'quantity' => $this->quantity,
            'discount' => $this->discount,
            'total' => $this->total,
            'paid' => $this->paid,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
        ];
    }
}
