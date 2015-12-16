$('select#ProgramSelect').chosen().change(function() {
    $('#program-details').html('<div class="text-center"><i class="fa fa-4x fa-spinner fa-spin"></i></div>');
    $('#program-details').load('program/ajaxProgramDetails/' + $(this).val());
});