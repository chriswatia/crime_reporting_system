<h1>Hi, {{ $name }}</h1>
<p>{{ $body }}</p>
<br />

{{-- Salutation --}}
@if (! empty($salutation))
{{ $salutation }}
@else
Regards,
<br />
{{ config('app.name') }} Team
@endif