$(window).load(function(){
    $('.questions').hide();
    $('.searchAction').hide();
    
    $('#Form_FilterUniversities_Country').find('option').filter(function() { 
        return this.text === 'Select a country';
    }).attr('selected', 'selected');
    
    $('.question-1').change(function(){
        $('.question-2').show(400, "linear");
        $("<option>").attr("value", "_loading").text("Loading countries.").appendTo($(".question-2").not(".field"));
        $.getJSON('http://localhost/silverstripe/academics/searchcountriesasjson', 
            function(data) {
                $(".question-2 option").remove();
                $("<option>").attr("value", "").text("Select a country").appendTo($(".question-2").not(".field"));
                $("<option>").attr("value", "_unsure").text("I'm not sure").appendTo($(".question-2").not(".field"));
                $.each(data, function(key, val) {
                    $("<option>").attr("value", val.value).text(val.title).appendTo($(".question-2").not(".field"))
                });
            });
    });
    
    $('.question-2').change(function(){
        $('.question-3').show(400, "linear");
        $('.searchAction').show();
    });

    $('.question-3').change(function(){
        $('.question-4').show(400, "linear");
    });

});