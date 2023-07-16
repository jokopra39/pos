<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PurchaseOrderResource extends JsonResource
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
            'purchase_order_id' => $this->purchase_order_id,
            'product_id' => $this->product_id,
            'quantity' => $this->quantity,
            'unit_price' => $this->unit_price,
            'sub_total' => $this->sub_total,
            'supplier_id' => $this->supplier_id,
            'order_date' => $this->order_date,
            'user_id' => $this->user_id,
        ];
        //return parent::toArray($request);
    }
}
