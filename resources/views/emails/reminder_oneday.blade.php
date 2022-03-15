@component('mail::message')
# Kära {{ $user->first_name }}

Vår middagsminister har omsorgsfullt valt ut **{{ $proposed->format('l d F') }}** som ett första förslag för dig att uppleva en kväll som middagsvärd med Invitationsdepartementet.

@component('mail::button', [
	'url' => route('dateselection', ['uuid' => $user->uuid]) . '?selected=' . $proposed->toDateString(),
	'color' => 'green'
])
Jag vill bjuda på middag {{ $proposed->format('l d F') }}
@endcomponent

Välj annars själv ett datum nu eller närsomhelst i vår kalender för att bjuda in till en minnesvärd måltid.

@component('mail::button', ['url' => route('dateselection', ['uuid' => $user->uuid])])
Välj eget datum
@endcomponent

Med värme,<br>
{{ config('app.name') }}
@endcomponent