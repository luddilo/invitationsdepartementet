<div id="new_children_container">
    @if (isset($children))
        @foreach($children as $index => $child)
            <div class="row child">
                <div class="col-md-12">
                    <div class="child form-inline">
                        {!! Form::label('children_age[' . $index . ']', trans('general.age_select')) !!}
                        {!! Form::number('children_age[' . $index . ']', $child, ['style' => 'width: 60px', 'class' => 'form-control']) !!}
                        <a style="margin-left: 5px" class="remove_input" href><i class="glyphicon glyphicon-remove-sign glyphicon-white"></i></a>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
</div>