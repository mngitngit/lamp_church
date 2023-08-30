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
@if ($registration->registration_type === 'Member')
@component('mail::subcopy')
<table>
    <tr>
        <td width="140">
            <img width="130" height="80" class="mx-2 mt-3 rounded shadow" src="https://online.lampawta.com/images/new_id.jpg">
        </td>
        <td style="word-break: normal !important; text-align: justify !important;">
            <small style="line-height: 0px; word-break: normal !important; text-align: justify !important;">Note: <i>A new LAMP ID Number is issued for you.</i> If you wish to replace your old AWTA card, an additional Php 35.00 will be required. Kindly reach out to your local AWTA Registrars for payment and issuance.</small>
        </td>
    </tr>
</table>
<br />
<br />
@endcomponent
@endif

Thanks,<br>
{{ config('app.name') }}
@endcomponent