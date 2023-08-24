@component('mail::message')
<center>
<label style="font-size: 20px; color: orange; font-weight: 600;">Booking On-Hold!<label>
</center>
<br />
<br />
 
<b>Hi {{ $name }},</b>

Please settle your balance or atleast pay partially to confirm your booking on or before the due date indicated below. Otherwise, your booking will automatically be cancelled.<br />

@component('mail::panel')
<b>Balance:</b> Php {{ $balance }}<br />
<b>Minimum Payment:</b> Php {{ $minimum }}<br />
<b>Payment Due Date:</b> {{ $due_date }}<br />
@endcomponent

To settle it, please reach out to your local AWTA Registrars.

Thank you and we hope to see you there!
 
@component('mail::button', ['url' => $url])
View Ticket
@endcomponent
 
Thanks,<br>
{{ config('app.name') }}
@endcomponent