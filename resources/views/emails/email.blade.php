@component('mail::message')
    {{ $message }}

    Thanks & Regards
    {{ config('app.name') }}
@endcomponent
