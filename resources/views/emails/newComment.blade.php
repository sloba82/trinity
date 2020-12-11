@component('mail::message')
# Hello  {{$name}}

You have new comment.
<p>{{$comment}}</p>


Thanks,<br>
{{ config('app.name') }}
@endcomponent
