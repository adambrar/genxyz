$(window).load(function(){

    var timeOut = null;
    
    // A self executing named function expression:

    (function autoAdvance(){
        
        // Simulating a click on the next arrow.
        $('#slideshow .next').trigger('click',[true]);
        
        // Schedulling a time out in 6 seconds.
        timeOut = setTimeout(autoAdvance,6000);
    })();

});