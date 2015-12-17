jQuery(function($) {'use strict';

	// Navigation Scroll
	$(window).scroll(function(event) {
		Scroll();
	});
                    
    // Match height panels and media boxes
    $('.match-height-boxes .match-height-box').matchHeight();

	$('.navbar-collapse ul li.scroll a').on('click', function() {  
		$('html, body').animate({scrollTop: $(this.hash).offset().top - 30}, 1000);
		return false;
	});
                    
    //initialize popover elements
    $('[data-toggle=popover]').popover();
                    
    // Message box controls
    $('#messages-select a').click(function(e) {
        e.preventDefault();
        $('#thread-content').html('<div class="text-center"><i class="fa fa-4x fa-spinner fa-spin"></i></div>');
        $('#thread-content').load( "message/ajaxMessageRequest", {'ThreadID':$(this).attr('data-message-id')});
        $(this).siblings().removeClass('active');
        $(this).addClass('active'); 
    });
                    
    // TinyMCE initialize
    if(typeof tinyMCE != 'undefined') {
        tinyMCE.init({
            theme : "advanced",
            mode: "textareas", 
            theme_advanced_toolbar_location : "top",
            theme_advanced_buttons1 : "bold,italic,underline,separator,justifyleft,justifycenter,justifyright,justifyfull,separator,outdent,indent,separator,undo,redo",
            theme_advanced_buttons2 : "",
            theme_advanced_buttons3 : "",
            height:"400px",
            width:"100%"
        });
        setTimeout(function () { 
            tinyMCE.activeEditor.onKeyPress.add(function(){$("textarea").val(tinyMCE.activeEditor.getContent());});
            tinyMCE.activeEditor.onPaste.add(function(ed, e){$("textarea").val(tinyMCE.activeEditor.getContent());});
        }, 2000);
    }
                    
    // Profile tab calls
    $('#profile-form-call a').click(function(e) {
        e.preventDefault();
        if(!$(this).hasClass('active')) {
            $('#profile-forms-content').html('<div class="text-center"><i class="fa fa-4x fa-spinner fa-spin"></i></div>');
            $.get('student/ajax_profile_form', {"Name": $(this).attr('data-form-name')}, function(data){$('#profile-forms-content').html(data);setTimeout(function(){$('#profile-forms-content').find('select').chosen({disable_search_threshold:10});},750);});
            $(this).siblings().removeClass('active');
            $(this).addClass('active');
        }
    });
                    
    $('.chosen-select select').chosen({
        disable_search_threshold:10
    });

	// User define function
	function Scroll() {
		var contentTop      =   [];
		var contentBottom   =   [];
		var winTop      =   $(window).scrollTop();
		var rangeTop    =   200;
		var rangeBottom =   500;
		$('.navbar-collapse').find('.scroll a').each(function(){
			var refName = $(this).attr('href').substring( $(this).attr('href').lastIndexOf('/') + 1, $(this).attr('href').length );
			contentTop.push( $( refName ).offset().top);
			contentBottom.push( $( refName ).offset().top + $( refName ).height() );
		})
		$.each( contentTop, function(i){
			if ( winTop > contentTop[i] - rangeTop ){
				$('.navbar-collapse li.scroll')
				.removeClass('active')
				.eq(i).addClass('active');			
			}
		})
	};

	$('.tohash').on('click', function(){
        var refName = $(this).attr('href').substring( $(this).attr('href').lastIndexOf('#'), $(this).attr('href').length );
		$('html, body').animate({scrollTop: $(refName).offset().top - 30}, 1000);
		return false;
	});

	// accordian
	$('.toggle-btn').on('click', function() {
        $(this).siblings().each(function() {
            $(this).next('.toggle-content').slideUp('slow');
            $(this).children().first().removeClass('fa-arrow-circle-down');
            $(this).children().first().addClass('fa-arrow-circle-right');
        });
		$(this).next('.toggle-content').slideToggle('slow');

	 	$(this).children().first().toggleClass('fa-arrow-circle-right fa-arrow-circle-down');
	});

	//Slider
	$(document).ready(function() {
		var time = 7; // time in seconds

	 	var $progressBar,
	      $bar, 
	      $elem, 
	      isPause, 
	      tick,
	      percentTime;
	 
	    //Init the carousel
	    $("#main-slider").find('.owl-carousel').owlCarousel({
	      slideSpeed : 900,
	      paginationSpeed : 600,
	      singleItem : true,
	      navigation : true,
			navigationText: [
			"<i class='fa fa-angle-left'></i>",
			"<i class='fa fa-angle-right'></i>"
			],
	      afterInit : progressBar,
	      afterMove : moved,
	      startDragging : pauseOnDragging,
	      //autoHeight : true,
	      transitionStyle : "fadeUp"
	    });
	 
	    //Init progressBar where elem is $("#owl-demo")
	    function progressBar(elem){
	      $elem = elem;
	      //build progress bar elements
	      buildProgressBar();
	      //start counting
	      start();
	    }
	 
	    //create div#progressBar and div#bar then append to $(".owl-carousel")
	    function buildProgressBar(){
	      $progressBar = $("<div>",{
	        id:"progressBar"
	      });
	      $bar = $("<div>",{
	        id:"bar"
	      });
	      $progressBar.append($bar).appendTo($elem);
	    }
	 
	    function start() {
	      //reset timer
	      percentTime = 0;
	      isPause = false;
	      //run interval every 0.01 second
	      tick = setInterval(interval, 10);
	    };
	 
	    function interval() {
	      if(isPause === false){
	        percentTime += 1 / time;
	        $bar.css({
	           width: percentTime+"%"
	         });
	        //if percentTime is equal or greater than 100
	        if(percentTime >= 100){
	          //slide to next item 
	          $elem.trigger('owl.next')
	        }
	      }
	    }
	 
	    //pause while dragging 
	    function pauseOnDragging(){
	      isPause = true;
	    }
	 
	    //moved callback
	    function moved(){
	      //clear interval
	      clearTimeout(tick);
	      //start again
	      start();
	    }
	});

	//Initiat WOW JS
	new WOW().init();
	//smoothScroll
	smoothScroll.init();

	$(document).ready(function() {
		//Animated Progress
		$('.progress-bar').bind('inview', function(event, visible, visiblePartX, visiblePartY) {
			if (visible) {
				$(this).css('width', $(this).data('width') + '%');
				$(this).unbind('inview');
			}
		});

		//Animated Number
		$.fn.animateNumbers = function(stop, commas, duration, ease) {
			return this.each(function() {
				var $this = $(this);
				var start = parseInt($this.text().replace(/,/g, ""));
				commas = (commas === undefined) ? true : commas;
				$({value: start}).animate({value: stop}, {
					duration: duration == undefined ? 1000 : duration,
					easing: ease == undefined ? "swing" : ease,
					step: function() {
						$this.text(Math.floor(this.value));
						if (commas) { $this.text($this.text().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,")); }
					},
					complete: function() {
						if (parseInt($this.text()) !== stop) {
							$this.text(stop);
							if (commas) { $this.text($this.text().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,")); }
						}
					}
				});
			});
		};

		$('.animated-number').bind('inview', function(event, visible, visiblePartX, visiblePartY) {
			var $this = $(this);
			if (visible) {
				$this.animateNumbers($this.data('digit'), false, $this.data('duration')); 
				$this.unbind('inview');
			}
		});
	});

	// Contact form
	var form = $('#main-contact-form');
	form.submit(function(event){
		event.preventDefault();
		var form_status = $('<div class="form_status"></div>');
		$.ajax({
			url: $(this).attr('action'),
			beforeSend: function(){
				form.prepend( form_status.html('<p><i class="fa fa-spinner fa-spin"></i> Email is sending...</p>').fadeIn() );
			}
		}).done(function(data){
			form_status.html('<p class="text-success">Thank you for contact us. As early as possible  we will contact you</p>').delay(3000).fadeOut();
		});
	});

	//Pretty Photo
	$("a[rel^='prettyPhoto']").prettyPhoto({
		social_tools: false
	});

});