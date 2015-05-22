$(window).load(function(){
    if($(".country-select-dropdown")[0]) {
        $.getJSON('http://localhost/silverstripe/home/countriesasjson', 
            function(data) {
                $.each(data, function(key, val) {
                    $("<option>").attr("value", val.value).text(val.title).appendTo($(".country-select-dropdown").not(".field"))
                });
        });
    }
    
    if($(".city-select-dropdown")[0]) {
        $.getJSON('http://localhost/silverstripe/home/citiesasjson', 
            function(data) {
                $.each(data, function(key, val) {
                    $("<option>").attr("value", val.value).text(val.title).appendTo($(".city-select-dropdown").not(".field"))
                });
        });
    }
});