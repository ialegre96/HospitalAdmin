@component('mail::message')
    <b>Hello Dr.{{$doctor_name}},</b>

    This is just to remind you that your appointment with {{$patient_name}} is within next one hour.

    Patient Problem: {{$problem}}<br>
    Appointment Time: {{ \Carbon\Carbon::parse($appointment_date)->format('jS M, Y g:i A') }}

    Thanks & Regards,<br>
    {{ config('app.name') }}
@endcomponent
