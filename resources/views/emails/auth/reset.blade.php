@component('mail::message')

<h3>Reset Password </h3>
<p>Hi {{$user->name}}</p>
<p>Your pin code is:</p>
<p><b> {{$user->pin_code}}</b></p>
Thanks,<br>
{{ config('app.name') }}
@endcomponent
