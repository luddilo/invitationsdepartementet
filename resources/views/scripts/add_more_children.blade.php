<script type="text/javascript">
    $('#add_more_children').on('click', function(e){
        e.preventDefault();
        // how many existing children input fields we have (for numbering of array)
        var existing_children = $('#new_children_container > .child').length;
        // create new child input and set the name property correctly
        var new_child = $('<input type="number" style="width: 60px" class="form-control" min="0" name=""></input>');
        var name = 'children_age[' + (existing_children) + ']';
        new_child.attr('name', name);
        new_child.attr('id', name);

        // create label
        var label = $('<label style="margin-right: 10px" for=""></label>');
        label.attr('for', name);
        label.text('{!! trans('general.age_select') !!}');
        // append it
        var div = $('<div style="margin-top: 5px; margin-bottom: 5px" class="child form-inline"></div>');
        var remove_icon = $('<a style="margin-left: 5px" class="remove_input" href><i class="glyphicon glyphicon-remove-sign glyphicon-white"></i></a>');

        remove_icon.on('click', function(e) {
            e.preventDefault();
            $(this).parent().remove();
        });

        div.append(label);
        div.append(new_child);
        div.append(remove_icon);

        $('#new_children_container').append(div);
    });

    $('.remove_input').on('click', function(e){
        e.preventDefault();
        $(this).parent().remove();
    });
</script>