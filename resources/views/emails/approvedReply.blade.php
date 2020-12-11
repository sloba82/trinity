@component('mail::message')
# Hello

You have reply on your comment!

{{$comment}}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
