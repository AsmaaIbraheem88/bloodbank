@component('mail::message')
# Introduction

The body of your message.

@component('mail::button', ['url' => ''])
Button Text
@endcomponent


<p>From: {{$data['email']}}</p>


Thanks,<br>
{{ config('app.name') }}
@endcomponent
