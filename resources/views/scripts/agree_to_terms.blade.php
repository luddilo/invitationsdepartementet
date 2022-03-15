<script type="text/javascript">
	function setSubmitBtnDisabled() {
        if ($('#agree_to_terms').prop('checked') && $('#agree_to_pul').prop('checked')) {
            $('#submit').attr('disabled', false);
        }
        else {
            $('#submit').attr('disabled', true);
        }
	}

	$(function() {
	    setSubmitBtnDisabled();
	});
    $('.agree_to').click(setSubmitBtnDisabled);
</script>