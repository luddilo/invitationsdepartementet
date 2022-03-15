<table class="table">
    <thead>
            <th>Region</th>
            <th>Typ av email</th>
			<th>Titel</th>
            <th>Paragraf 1</th>
            <th>Paragraf 2</th>
            <th>Paragraf 3</th>
            <th>Signature</th>
            <th width="50px">Action</th>
    </thead>
    <tbody>
    @foreach($emailTemplates as $emailTemplate)
        <tr>
            <td>{!! $emailTemplate->region_id != 0 ? $emailTemplate->region->name : 'Default' !!}</td>
            <td>{!! $emailTemplate->getEmailType() !!}</td>
            <td>{!! str_limit($emailTemplate->title, 55, '...')  !!}</td>
			<td>{!! str_limit($emailTemplate->paragraph1, 55, '...') !!}</td>
            <td>{!! str_limit($emailTemplate->paragraph2, 55, '...') !!}</td>
            <td>{!! str_limit($emailTemplate->paragraph3, 55, '...') !!}</td>
            <td>{!! str_limit(strip_tags($emailTemplate->signature), 55, '...') !!}</td>
            <td>
                <a href="{!! route('app.emailtemplates.edit', [$emailTemplate->id]) !!}"><i class="glyphicon glyphicon-edit"></i></a>
                <a href="{!! route('app.emailtemplates.delete', [$emailTemplate->id]) !!}" onclick="return confirm('Are you sure wants to delete this email template?')"><i class="glyphicon glyphicon-remove"></i></a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
