@component('mail::message')
# Introduction

You are logged in from
{{ $agent->platform()}}


TIME{{ now() }}
Your browser
{{  $agent->browser() }}

{{ $agent->version($agent->browser())}}


@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
