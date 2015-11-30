$(window).load(function(){

    //Application edit modal load
    $('#editModal').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget)
      
      var modal = $(this)
      modal.find('.modal-body').load(
        "application/getform/SchoolApplicationEdit/"
        +button.attr('data-application-id')
      );
    })
    
    $('.modal').on('hidden.bs.modal', function(event) {
        $(this).find('.modal-body').html('<h2 class="text-center"><i class="fa fa-2x fa-spinner fa-spin"></i></h2>');
    })
});