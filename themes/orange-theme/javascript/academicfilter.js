$(window).load(function(){
    $.urlParam = function(name){
        var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
        if (results==null){
           return null;
        }
        else{
           return results[1] || 0;
        }
    }
    
    $.getJSON(location.href + '/searchcountriesasjson', 
            function(data) {
                $.each(data, function(key, val) {
                    $("<option>").attr("value", val.value).text(val.title).appendTo($(".filter-by-country").not(".field"))
                });
    });
    
    function setSelects() { 
        if($.urlParam('Program')) { $('.filter-by-program select').val($.urlParam('Program')); } 
        if($.urlParam('Country')) { $('.filter-by-country select').val($.urlParam('Country')); } 
    }
    
    setTimeout(setSelects, 1000);
        
});