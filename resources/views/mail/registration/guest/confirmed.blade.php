@component('mail::message')

<b>Hi {{ $name }},</b>

We're so glad you are joining us to offer worship & thanksgiving to the Lord of lords!

Here are the details:<br /><br />
<b>Event Date:</b> December 27 - 30, 2023 <br />
<b>Theme:</b> Year of Clustering <br />
<b>Live Broadcast:</b> via Zoom & Facebook Live
<br /><br />
Join our FB Group to watch the live broadcast
@component('mail::button', ['url' => $url])
Join Facebook Group
@endcomponent

You may also join us via Zoom: 
@component('mail::panel')
<a href="https://us02web.zoom.us/j/81746669062?pwd=MlpQbDk2R2Zjbzl3ZWdWNWdqWWYxQT09">https://us02web.zoom.us/j/81746669062?pwd=MlpQbDk2R2Zjbzl3ZWdWNWdqWWYxQT09</a>

Meeting ID: 817 4666 9062<br />
Passcode: AWTA2023
@endcomponent

We will be sending a reminder before the event starts too!

See you there! 

Thanks,<br>
{{ config('app.name') }}
@endcomponent