<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RegistrationResource extends JsonResource
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
            'created_at' => $this->created_at,
            'uuid' => $this->uuid,
            'email' => $this->email,
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
            'fullname' => $this->fullname,
            'facebook_name' => $this->facebook_name,
            'registration_type' => $this->registration_type,
            'local_church' => $this->local_church,
            'country' => $this->country,
            'category' => $this->category,
            'attending_option' => $this->attending_option,
            'rate' => $this->rate,
            'payment_status' => $this->payment_status,
            'with_awta_card' => $this->with_awta_card,
            'with_accommodation' => $this->with_accommodation,
            'mode_of_transpo' => $this->mode_of_transpo,
            'priority_dates' => implode(', ', json_decode($this->priority_dates))
        ];
    }
}
