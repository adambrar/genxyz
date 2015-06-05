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
    
    function setSelects() { 
        if($.urlParam('Program')) { $('.filter-by-program select').val($.urlParam('Program')); } 
        if($.urlParam('Country')) { $('.filter-by-country select').val($.urlParam('Country')); } 
    }
    
    setTimeout(setSelects, 1000);
        
});