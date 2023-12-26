@component('mail::message')
 
<b>Hi {{ $name }},</b>

We are reaching out to remind you about our highly anticipated Annual Worship and Thanksgiving Assembly, which is happening TOMORROW!

We're excited to celebrate God's faithfulness and share our gratitude together, get ready to raise your voice and hands for the Lord of lords!

Here's how you can join:<br />
@component('mail::panel')
<b>Zoom Meeting:</b><br />
<a href="https://us02web.zoom.us/j/81934498358?pwd=MDhGcXpiMitiT1JYU0V2dGhWZy91dz09">https://us02web.zoom.us/j/81934498358?pwd=MDhGcXpiMitiT1JYU0V2dGhWZy91dz09</a><br /><br />
Meeting ID: 819 3449 8358 <br />
Passcode: AWTA2023 <br />
<br /><br />
<b>Facebook Live:</b><br />
Join the LAMP Church Facebook Group:  <a href="{{ $url }}">Click to Join Group</a><br /><br />
Tune in LIVE tomorrow at 4PM
@endcomponent

Whether you join via Zoom or Facebook Live, we can't wait to see you there! Share the event with your friends and family and spread the joy. 


BE BLESSED PHYSICALLY, MATERIALLY, & SPIRITUALLY.


With warmest regards,<br>
{{ config('app.name') }}


<small>P.S. Don't forget to share your photos and thanksgiving messages on social media using #LAMPWorldwideAWTA2023 #YearofClustering!</small>
@endcomponent

