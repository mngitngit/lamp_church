<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ExportReceivedHGResource extends JsonResource
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
            'uuid' => $this->registration->uuid,
            'event_date' => date_format($this->slot->event_date, "F d, Y"),
            'firstname' => $this->registration->firstname,
            'lastname' => $this->registration->lastname,
            'registration_type' => $this->registration->registration_type,
            'local_church' => $this->registration->local_church,
            'cluster_group' => $this->registration->cluster_group,
            'altar_worker' => $this->notes
        ];
    }
}
