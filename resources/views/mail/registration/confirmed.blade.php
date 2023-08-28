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
<a href="https://us02web.zoom.us/j/81746669062?pwd=MlpQbDk2R2Zjbzl3ZWdWNWdqWWYxQT09">https://us02web.zoom.us/j/81746669062?pwd=MlpQbDk2R2Zjbzl3ZWdWNWdqWWYxQT09</a><br />
<br />
Meeting ID: 817 4666 9062<br />
Passcode: AWTA2023
<br /><br />
We will be sending a reminder before the event starts too!

For more updates, please join our facebook group: <a href="https://www.facebook.com/groups/446318280091482">https://www.facebook.com/groups/446318280091482</a>

See you there! 

Thanks,<br>
{{ config('app.name') }}
@endcomponent