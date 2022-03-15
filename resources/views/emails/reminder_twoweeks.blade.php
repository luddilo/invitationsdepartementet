@component('mail::message')
# Hej {{ $user->first_name }},

Invitationsdepartementet bygger på enkelheten i att ställa ut en tallrik eller två extra och förhoppningsvis äter du mat några kvällar i veckan. Vardagsmat går alldeles utmärkt, alla dagar är mer eller mindre lika populära och du behöver verkligen inte städa hela ditt hem.

Vår middagsminister har noga valt ut **{{ $proposed->formatLocalized('%A %d %B') }}** som ett förslag för dig att uppleva en kväll som middagsvärd med Invitationsdepartementet.

@component('mail::button', [
	'url' => route('dateselection', ['uuid' => $user->uuid]) . '?selected=' . $proposed->toDateString(),
	'color' => 'green'
])
Jag vill bjuda på middag {{ $proposed->formatLocalized('%A %d %B') }}
@endcomponent

Välj annars själv ett datum nu eller närsomhelst i vår kalender för att bjuda in till en minnesvärd måltid.

@component('mail::button', ['url' => route('dateselection', ['uuid' => $user->uuid])])
Välj eget datum
@endcomponent

Med värme,<br>
{{ config('app.name') }}
@endcomponent