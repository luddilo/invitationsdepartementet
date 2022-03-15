<div class="panel panel-default">
    <div class="panel-heading">
        Titel: {!! $emailTemplate->title !!}
    </div>
    <div class="panel-body">
        <p>{!! sprintf(config('constants.emailTemplateDefaults')['intro_greeting'], 'FÖRNAMN') !!}</p>
        <p>{!! nl2br($emailTemplate->paragraph1) !!}</p>
        <p>{!! nl2br($emailTemplate->paragraph2) !!}</p>
        <p>{!! nl2br($emailTemplate->paragraph3) !!}</p>
        <p>
            {!! config('constants.emailTemplateDefaults')['outtro_greeting'] !!}<br>
            Invitationsdepartementet REGION
        </p>
        <p>
            {!! nl2br($emailTemplate->signature) !!}
        </p>
    </div>
</div>