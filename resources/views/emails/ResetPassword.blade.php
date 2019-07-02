@component('mail::message')
# Introduction

Blood Bank Reset Password.

@component('mail::button', ['url' => 'http://para-eg.com' , 'color' => 'success'])
Rest
@endcomponent




<p>Your Reset Code Is:{{$code}}</p>



Thanks,<br>
{{ config('app.name') }}
@endcomponent
