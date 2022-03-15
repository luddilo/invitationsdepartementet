<script type="text/javascript">
    $('#add_more_partners').on('click', function(e){
    e.preventDefault();
    // how many existing children input fields we have (for numbering of array)
    var existing_partners = $('#new_partners_container > .partner').length;
    // create new child input and set the name property correctly
    var new_partner_gender = $('<select class="partner_gender form-control" name=""><option value="F">{!! trans('general.female') !!}</option><option value="M">{!! trans('general.male') !!}</option></select>');

    var gender = 'partner_gender[' + (existing_partners) + ']';

    new_partner_gender.attr('name', gender);
    new_partner_gender.attr('id', gender);

    // create label
    var label_gender = $('<label style="margin-right: 10px" for=""></label>');
    label_gender.attr('for', gender);
    label_gender.attr('id', gender);
    label_gender.text('{!! trans('general.gender_select') !!} ');

    // append it
    var div = $('<div style="margin-top: 5px; margin-bottom: 5px" class="partner form-inline"></div>');
    var remove_icon = $('<a style="margin-left: 5px" class="remove_input" href><i class="glyphicon glyphicon-remove-sign glyphicon-white"></i></a>');

    remove_icon.on('click', function(e) {
        e.preventDefault();
        $(this).parent().remove();
    });

    div.append(label_gender);
    div.append(new_partner_gender);
    div.append(remove_icon);

    $('#new_partners_container').append(div);

});

$('.remove_input').on('click', function(e){
    e.preventDefault();
    $(this).parent().remove();
});

</script>