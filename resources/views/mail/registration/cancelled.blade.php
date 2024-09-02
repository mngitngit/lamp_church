@component('mail::message')
<center>
<label style="font-size: 20px; color: red; font-weight: 600;">Booking Cancelled!<label>
</center>
<br />
<br />
 
<b>Hi {{ $name }},</b>

We're sorry to inform you that your booking for {{ $booked_dates }} has been cancelled.<br />

Please rebook and provide the following details:
@component('mail::panel')
<b>Last Name:</b> {{ $registration->lastname }}<br />
<b>Local Church:</b> {{ $registration->local_church }}<br />
<b>LAMP ID:</b> {{ $registration->uuid }}<br />
@endcomponent
 
@component('mail::button', ['url' => $url])
<center>Manage Booking</center>
@endcomponent
 
Thanks,<br>
{{ config('app.name') }}
@endcomponent