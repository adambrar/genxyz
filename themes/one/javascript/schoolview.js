$('select#ProgramSelect').chosen().change(function() {
    $('#program-details').html('<div class="text-center"><i class="fa fa-4x fa-spinner fa-spin"></i></div>');
    $('#program-details').load('program/ajaxProgramDetails/' + $(this).val());
});
$('.rating-button').click( function() {
    $('.rating-response-text').html('');
    var link = 'school/rateschool/'+$(this).attr('data-school-id')+'/'+$('.rating-vote').rating('rate');
    $.getJSON(link, { reviewcontent: escape($('#rating-textarea').val()) }, function( data ) {
        $('.rating-response-text').html(data['responsetext']);
    });
});
$('#interest-button').click( function() {
    $(".interest-response").html('<i class="fa fa-spinner fa-spin"></i>');
    var link = 'application/school/'+$(this).attr('data-school-id');
    $.get(link, function(text) {
        $(".interest-response").html(text);
    });
    
});