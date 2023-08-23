@component('mail::message')
<center>
<label style="font-size: 20px; color: #6ea56e; font-weight: 600;">Booking Confirmed!<label>
</center>
<br />
<br />

<b>Hi {{ $name }},</b>

Congratulations, your booking is already confirmed!

@component('mail::panel')
<b>Booked Dates:</b> {{ $booked_dates }}<br />
<b>Location:</b> Calamba Tent, CMC Avenue, Crossing, Calamba City, Laguna  <a href="https://goo.gl/maps/avYUt5rPss9HDtDo7">View Location</a> <br />
<b>Event Time:</b> 4PM<br />
<b>Theme:</b> Year of Clustering<br />
@endcomponent

@component('mail::button', ['url' => $url])
View Ticket
@endcomponent

You may also join us via Zoom: <br />
<a href="https://us02web.zoom.us/j/88691518236?pwd=Z0xiQUFkd2FndER6M2NrUUhyVFBPQT09">https://us02web.zoom.us/j/88691518236?pwd=Z0xiQUFkd2FndER6M2NrUUhyVFBPQT09</a><br />
<br />
Meeting ID: 886 9151 8236<br />
Passcode: 2022AWTA
<br /><br />
We will be sending a reminder before the event starts too!

For more updates, please join our facebook group: <a href="https://www.facebook.com/groups/446318280091482">https://www.facebook.com/groups/446318280091482</a>

See you there! 

Thanks,<br>
{{ config('app.name') }}
@endcomponent