@component('mail::message')
    <b>Dear {{ $patient_name }},</b>

    Hope you are having a great day!!

    This is a friendly reminder that your appointment with <b>Dr.{{$doctor_name}}</b> is within next one hour.

    Your Problem: {{$problem}}<br>
    Appointment Time: {{ \Carbon\Carbon::parse($appointment_date)->format('jS M, Y g:i A') }}

    You may contact us with your suitable time for your Doctor Appointment & we are here to assist you 24/7.

    Thanks & Regards,<br>
    {{ config('app.name') }}
@endcomponent
