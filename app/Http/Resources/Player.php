<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Player extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        if ($request->input('mode') === 'simple') {
            return [
                'id' => $this->reference_id,
                'full_name' => $this->data['first_name'] . ' ' . $this->data['second_name']
            ];
        }

        return [
            'id' => $this->reference_id,
            $this->merge($this->data),
        ];
    }
}
