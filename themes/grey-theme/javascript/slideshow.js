$(window).load(function(){
	// Testing wether the current browser supports the canvas element:
	var supportCanvas = false;//'getContext' in document.createElement('canvas');

	var slides = $('#slideshow li'),
		current = 0,
		slideshow = {width:0,height:0};

	setTimeout(function(){
		
		window.console && window.console.time && console.time('Generated In');
		
		window.console && window.console.timeEnd && console.timeEnd('Generated In');
		
		$('#slideshow .arrow').click(function(){
			var li			= slides.eq(current),
				canvas		= li.find('canvas'),
				nextIndex	= 0;

			// Depending on whether this is the next or previous
			// arrow, calculate the index of the next slide accordingly.
			
			if($(this).hasClass('next')){
				nextIndex = current >= slides.length-1 ? 0 : current+1;
			}
			else {
				nextIndex = current <= 0 ? slides.length-1 : current-1;
			}

			var next = slides.eq(nextIndex);
            
            current=nextIndex;
            next.addClass('slideActive').show();
            li.removeClass('slideActive').hide();
        
		});
		
	},100);
    
    
    var topMargin = parseFloat($("#slideshow-overlay").offset().top) - parseFloat($(window).height())*2/5;
    
    if(topMargin >= parseFloat($("#slideshow-overlay").offset().top)){
        topMargin = 0;
    }
    
    $("#slideshow-overlay").css({"margin-top":"-" + topMargin.toString() + "px"});

});
