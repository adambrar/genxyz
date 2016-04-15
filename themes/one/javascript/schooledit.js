$(window).load(function(){
    // color picker
    $('#Form_ProfileLinksForm_ProfileColour').spectrum({
change: function(color){$('#Form_ProfileLinksForm_ProfileColour').val(color.toHex());},});
    //edit service load
    $('.edit-program-select select').change(function() {
        $('#Form_EditProgramForm').overlay();
        $('.CostField').val('');
        $.getJSON($(this).attr('data-ajax-link'),
            {'ProgramID':this.value},
            function(data) {
                $.each(data,function(key,val) {
                    if(val.value) {
                        $('#Form_EditProgramForm_'+val.title).val(val.value);
                    } else {
                        $('#Form_EditProgramForm_'+val.title).val('');
                    }
                });
            $.overlayout();
        });
    });
    
});