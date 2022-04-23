@component('mail::message')
    # Hello {{  $patient_name }},

    This is a friendly reminder for your doctor appointment on {{ \Carbon\Carbon::parse($appointment_date)->format('jS M, Y g:i A') }}.

    Your Problem: {{$problem}}
    Doctor Name: {{$doctor_name}}

    You may contact us with your suitable time for your Doctor Appointment & we are here to assist you 24/7.

    Thanks & Regards,
    {{ config('app.name') }}
@endcomponent
