@extends('layouts.app')

@section('content')
<div class="col-md-12">
    <h2>Skickade mail</h2>

    <table class="table">
        <thead>
            <tr>
                <th>Mail</th>
                <th>Region</th>
                <th>Från</th>
                <th>Till</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($emails as $email)
            <tr>
                <td>{{ config('constants.emailTypes.' . $email->email_type) }}</td>
                <td>{{ $email->region->name or '-' }}</td>
                <td>{{ $email->sender->email or '-' }}</td>
                <td>{{ $email->user->email or '-' }}</td>
                <td>
                    <span class="label label-success" title="Skickades: {{ $email->sent_at }}">Skickat</span>
                    @if ($email->delivered_at != null)
                    <span class="label label-success" title="Mottogs: {{ $email->delivered_at }}">Mottaget</span>
                    @endif

                    @if ($email->opened_at != null)
                    <span class="label label-success" title="Öppnades: {{ $email->opened_at }}">Öppnat</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection