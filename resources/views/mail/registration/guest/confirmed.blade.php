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
<a href="https://us02web.zoom.us/j/88691518236?pwd=Z0xiQUFkd2FndER6M2NrUUhyVFBPQT09">https://us02web.zoom.us/j/88691518236?pwd=Z0xiQUFkd2FndER6M2NrUUhyVFBPQT09</a>

Meeting ID: 886 9151 8236<br />
Passcode: 2022AWTA
@endcomponent

We will be sending a reminder before the event starts too!

See you there! 

Thanks,<br>
{{ config('app.name') }}
@endcomponent