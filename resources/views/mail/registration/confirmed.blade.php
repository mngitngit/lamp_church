@component('mail::message')
<center>
<label style="font-size: 20px; color: #6ea56e; font-weight: 600;">Booking Confirmed!<label>
</center>
<br />
<br />

<b>Hi {{ $name }},</b>

Your booking for {{ $booked_dates }} is already confirmed!

@component('mail::button', ['url' => $url])
View Ticket
@endcomponent

For more updates, please join our facebook group: <a href="https://www.facebook.com/groups/446318280091482">https://www.facebook.com/groups/446318280091482</a>

See you there! 

Thanks,<br>
{{ config('app.name') }}
@endcomponent