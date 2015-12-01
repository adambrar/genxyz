$(window).load(function(){
    
    //edit service load
    $('.edit-service-select select').change(function() {
        $('.DescriptionField').val('LOADING...');
        $('.CostField').val('');
        $.getJSON('/agent/ajaxServiceRequest',
            {'ServiceID':this.value},
            function(data) {
                $.each(data,function(key,val) {
                    if(val.value) {
                        $('.'+val.title).val(val.value);
                    } else {
                        $('.'+val.title).val('');
                    }
                });
        });
    });
    
    //Application edit modal load
    $('#editModal').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget)
      
      var modal = $(this)
      modal.find('.modal-body').load(
        "application/getform/SchoolApplicationDetails/"
        +button.attr('data-application-id')
      );
    })
    
    $('.modal').on('hidden.bs.modal', function(event) {
        $(this).find('.modal-body').html('<h2 class="text-center"><i class="fa fa-2x fa-spinner fa-spin"></i></h2>');
    })
    
    //Application files modal load
    $('#filesModal').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget)
      
      var modal = $(this)
      modal.find('.modal-body').load(
      "application/getform/SchoolApplicationFiles/"             
      +button.attr('data-application-id'));
    })
});