@if (count($dinner->emails) > 0)
<div class="col-md-12">
    <h2>Skickade mail</h2>

    <table class="table">
        <thead>
            <tr>
                <th>Mail</th>
                <th>Skickad till</th>
                <th>Skickad</th>
                <th>Mottagen</th>
                <th>Öppnad</th>
            </tr>
        </thead>
        <tbody>
            @foreach($dinner->emails as $email)
            <tr>
                <td>{{ config('constants.emailTypes.' . $email->email_type) }}</td>
                <td>{{ $email->user->email }}</td>
                <td>{{ $email->sent_at }}</td>
                <td>{{ $email->delivered_at }}</td>
                <td>{{ $email->opened_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endif