$(window).load(function(){
    $(".country-for-city-select select").change(function() {
        var params = {"Country": $(".country-for-city-select select").val()};
        $(".city-select-dropdown select").html('');
        $("<option>").attr("value", "").text("Select a City").appendTo($(".city-select-dropdown").not(".field"))
        $.getJSON(location.origin + '/silver/home/citiesasjson', params,
        function(data) {
            $.each(data, function(key, val) {
                $("<option>").attr("value", val.value).text(val.title).appendTo($(".city-select-dropdown").not(".field"))
            });
        });
    });
    
    if($('.tab-pane')[0]) {
        $('.tab-pane.active').find('.chosen-select select').chosen();
        //create chosen select on tab switch
    } else {
        $('chosen-select select').chosen();
    }
    
});