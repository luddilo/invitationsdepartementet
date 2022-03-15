
<p>
    {!! $note->author->getFullName() . ' (' . date('d-M H:i', strtotime($note->created_at)) . '):' !!}<br/>
    {!! $note->content !!}
</p>