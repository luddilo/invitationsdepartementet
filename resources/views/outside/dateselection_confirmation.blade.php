@extends('layouts.outside')

@section('content')

    <div style="background-color: rgba(255,255,255,0.9)" class="container-fluid wrapper-landing">
        <div class="col-md-12">

            @include('common.errors')

            <h1>Tack!</h1>
            <h2>Du får nu ett mejl med ditt valda datum. Kolla skräpfiltret så att det och framtida information inte hamnar på villovägar. Vi hör av oss senast 72h innan middagen med information om din gäst. Om vi inte skulle hitta någon och behöver skjuta på middagen, hör vi givetvis också av oss.
                <br/><br/>

                Dela gärna på
                <a style="margin-left:3px; margin-right: 3px;" class="btn btn-default btn-sm" id="share">
                    <i class="fa fa-facebook-square"></i> Facebook
                </a> så länge. <3
            </h2>
        </div>
    </div>

@endsection

@push('scripts')
<script>
var FB;

window.fbAsyncInit = function() {
  FB.init({
    appId      : '1899773346974799',
    xfbml      : true,
    version    : 'v2.8'
  });
  FB.AppEvents.logPageView();
};

(function(d, s, id){
   var js, fjs = d.getElementsByTagName(s)[0];
   if (d.getElementById(id)) {return;}
   js = d.createElement(s); js.id = id;
   js.src = "//connect.facebook.net/sv_SE/sdk.js";
   fjs.parentNode.insertBefore(js, fjs);
 }(document, 'script', 'facebook-jssdk'));

$(function() {
    $("#share").click(function () {
        FB.ui({
            method: 'share',
            display: 'popup',
            href: 'http://invitationsdepartementet.se',
            caption: 'Holy guacamole! Har precis bokat in en middag med Invitationsdepartementet'
        }, function(response){});
    });
});
</script>
@endpush
