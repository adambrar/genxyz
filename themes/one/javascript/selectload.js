$(window).load(function(){
    if($(".country-select-dropdown")[0]) {
        $.getJSON(location.origin + '/silver/home/countriesasjson', 
            function(data) {
                $.each(data, function(key, val) {
                    $("<option>").attr("value", val.value).text(val.title).appendTo($(".country-select-dropdown").not(".field"))
                });
                $(".country-select-dropdown select").each( function() {
                    $(this).val("selected");
                    var selectedCountry = $(this).find('option:selected').text();
                    $(this).find('option[value=selected]').remove();
                    $(this).val(parseInt(selectedCountry));
                });
            
                if($(".country-for-city-select select")[0]) {
                    var params = {"Country": $(".country-for-city-select select").val()};
                    $.getJSON(location.origin + '/silver/home/citiesasjson', params,
                    function(data) {
                        $.each(data, function(key, val) {
                            $("<option>").attr("value", val.value).text(val.title).appendTo($(".city-select-dropdown").not(".field"))
                        });
                    });
                }
        });
    }
    
    $(".country-for-city-select select").change(function() {
        var params = {"Country": $(".country-for-city-select select").val()};
        $(".city-select-dropdown select").html('');
        $("<option>").attr("value", "").text("Select a City").appendTo($(".city-select-dropdown").not(".field"))
        $.getJSON(location.origin + '/silver/home/citiesasjson', params,
        function(data) {
            $.each(data, function(key, val) {
                $("<option>").attr("value", val.value).text(val.title).appendTo($(".city-select-dropdown").not(".field"))
            });
        });}); 
    
        $(".profile-picture-edit").click(function() {
            $(".profile-picture-form").trigger("click");
            $('html, body').animate({
                scrollTop: $(".profile-picture-form").offset().top
            }, 500);
        });

    
});