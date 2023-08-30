<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ExportRegistrationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $booked = $this->bookings()->with('slot')->get()->toArray();

        $booked_dates = array_map(function ($date) {
            return $date['slot']['event_date'];
        }, $booked);

        $attendances = $this->attendances()->with('slot')->get()->toArray();

        $attended_dates = array_map(function ($date) {
            return $date['slot']['event_date'];
        }, $attendances);

        return [
            'created_at' => $this->created_at,
            'uuid' => $this->uuid,
            'email' => $this->email,
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
            'facebook_name' => $this->facebook_name,
            'registration_type' => $this->registration_type,
            'local_church' => $this->local_church,
            'cluster_group' => $this->cluster_group,
            'country' => $this->country,
            'category' => $this->category,
            'attending_option' => $this->attending_option,
            'with_awta_card' => $this->with_awta_card,
            'avail_new_lamp_id' => $this->avail_new_lamp_id,
            'booked_dates' => implode(', ', $booked_dates),
            'booking_status' => $this->booking_status,
            'attended_dates' => implode(',', $attended_dates),
            'rate' => $this->rate,
            'payment_status' => $this->payment_status,
            'payments_sum_amount' => $this->payments_sum_amount,
            'medical_assistance_needed' => $this->medical_assistance_needed,
            'visitor_to_member' => $this->visitor_to_member
        ];
    }
}
