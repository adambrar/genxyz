<% include Header %>
<div class="main" role="main">
    <div id="main-wrapper">
        <div class="container">
            <div id="content">
                <div class="content-container unit size3of4 lastUnit">
                    <article>
                        <div class="content">
                            <div class="row content-box-dark">
                                <div class="9u 12u(1)">
                                    <div class="row">
                                        <div class="3u"><% if Logo %><a href="http://{$Member.BusinessWebsite}" class="image fit"><img style="max-height:6em" src="{$BaseHref}{$Logo.Filename}" alt="Logo" /></a><% end_if %></div>
                                            <div class="9u"><h2><a href="http://{$Member.BusinessWebsite}">$Member.BusinessName</a></h2><h1>University of Names Tagline</h1></div>
                                    </div>
                                    <ul class="tabs">
                                        <li class="tab-link current" data-tab="tab-1">Home</li>
                                        <li class="tab-link" data-tab="tab-2">AboutUs</li>
                                        <li class="tab-link" data-tab="tab-3">Academic Programs</li>
                                        <li class="tab-link" data-tab="tab-4">Contact Us</li>
                                        <li id="search-bar" data-tab="tab-5"><span style="font-weight:800">Apply</span></li>
                                    </ul>

                                    <div id="tab-1" class="tab-content current">
                                        <div class="row">
                                            <div class="6u 12u(1)">
                                                <iframe width="420" height="315"
src="http://www.youtube.com/embed/XGSy3_Czz8k?showinfo=0"></iframe>
                                            </div>
                                            <div class="6u 12u(2)">
                                                <div class="slides-container">
                                                    <div id="slides">
                                                      <img src="{$ThemeDir}/images/Desert.jpg" alt="Photo by: Missy S Link: http://www.flickr.com/photos/listenmissy/5087404401/">
                                                      <img src="{$ThemeDir}/images/Jellyfish.jpg" alt="Photo by: Daniel Parks Link: http://www.flickr.com/photos/parksdh/5227623068/">
                                                      <img src="{$ThemeDir}/images/Hydrangeas.jpg" alt="Photo by: Mike Ranweiler Link: http://www.flickr.com/photos/27874907@N04/4833059991/">
                                                      
                                                      <a href="#" class="slidesjs-previous slidesjs-navigation" title="Previous"><i class="fa fa-chevron-left icon-large"></i></a>
                                                      <a href="#" class="slidesjs-next slidesjs-navigation" title="Next"><i class="fa fa-chevron-right icon-large"></i></a>
                                                    </div>
                                                  </div>
                                            </div>
                                        </div>
                                        <br/>
                                        <h2>Testimonials!</h2>
                                        <div class="row testimonials">
                                            <div class="4u testimonial">
                                                <p><i class="fa fa-quote-left fa-pull-left"></i> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque sit amet eleifend massa, id viverra tortor. Vestibulum sed ultrices nisi. Proin euismod enim sit amet mauris fringilla malesuada. Phasellus fringilla nisl id enim iaculis, ut placerat orci finibus. Maecenas eget magna eu urna gravida vulputate. In quis ornare ante, vitae viverra leo. Pellentesque tempus in magna at eleifend. <i class="fa fa-quote-right fa-pull-right"></i></p>
                                                <h1 style="float:right" class="testimonial-author">- Adam Brar</h1>
                                                
                                            </div>
                                            <div class="4u testimonial">
                                                <p><i class="fa fa-quote-left fa-pull-left"></i> Donec sed erat volutpat, iaculis eros nec, eleifend augue. Sed nec interdum sem. Nam faucibus dui eu erat sodales aliquam. Sed sagittis a lorem ac mollis. <i class="fa fa-quote-right fa-pull-right"></i></p>
                                                <h1 style="float:right" class="testimonial-author">- Carman Lam</h1>
                                            </div>
                                            <div class="4u testimonial">
                                                <p><i class="fa fa-quote-left fa-pull-left"></i> In id dictum lacus, a sagittis felis. Maecenas porta erat nec risus cursus, nec placerat velit condimentum. Quisque cursus lorem vitae ex laoreet porttitor. Nunc lacus quam, faucibus sit amet semper sit amet, commodo sed urna. Duis eget mollis nibh. Etiam dapibus euismod enim, ut iaculis turpis mattis ac. <i class="fa fa-quote-right fa-pull-right"></i></p>
                                                <h1 style="float:right" class="testimonial-author">- Nelly Young</h1>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="tab-2" class="tab-content">
                                        <h2>Mission Statement</h2>
                                        <p>$ProfilePage.MissionStatement</p>
                                        <h2>Values</h2>
                                        <p>$ProfilePage.Values</p>
                                        <h2>Vision</h2>
                                        <p>$ProfilePage.Vision</p>
                                    </div>
                                    <div id="tab-3" class="tab-content">
                                        List of academic programs in alphabetic order.
                                        <div class="university-programs">
                                            <div class="slider-content">
                                                <h1 class="content-slider"><i class="fa fa-arrow-circle-right fa-fw fa-2x"></i>Nursing</h1>
                                                <div class="hidden-content">
                                                    <ul>
                                                        <li>Certificate</li>
                                                        <li>Diploma</li>
                                                        <li>Degree</li>
                                                        <li>Masters</li>
                                                        <li>Doctorate</li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="slider-content">
                                                <h1 class="content-slider"><i class="fa fa-arrow-circle-right fa-fw fa-2x"></i>Engineering</h1>
                                                <div class="hidden-content">
                                                    <ul>
                                                        <li>Certificate</li>
                                                        <li>Diploma</li>
                                                        <li>Degree</li>
                                                        <li>Masters</li>
                                                        <li>Doctorate</li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="slider-content">
                                                <h1 class="content-slider"><i class="fa fa-arrow-circle-right fa-fw fa-2x"></i>Sociology</h1>
                                                <div class="hidden-content">
                                                    <ul>
                                                        <li>Certificate</li>
                                                        <li>Diploma</li>
                                                        <li>Degree</li>
                                                        <li>Masters</li>
                                                        <li>Doctorate</li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="slider-content">
                                                <h1 class="content-slider"><i class="fa fa-arrow-circle-right fa-fw fa-2x"></i>Philosophy</h1>
                                                <div class="hidden-content">
                                                    <ul>
                                                        <li>Certificate</li>
                                                        <li>Diploma</li>
                                                        <li>Degree</li>
                                                        <li>Masters</li>
                                                        <li>Doctorate</li>
                                                    </ul>
                                                </div>
                                            </div>                                            
                                            <div class="slider-content">
                                                <h1 class="content-slider"><i class="fa fa-arrow-circle-right fa-fw fa-2x"></i>Pharmacy</h1>
                                                <div class="hidden-content">
                                                    <ul>
                                                        <li>Certificate</li>
                                                        <li>Diploma</li>
                                                        <li>Degree</li>
                                                        <li>Masters</li>
                                                        <li>Doctorate</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="tab-4" class="tab-content">
                                        <p>1234 Fakie Street</p>
                                        <p>Whitehorse, Yukon</p>
                                        <p>Canada</p>
                                        <p>Y0A 1W0</p>
                                    </div>
                                    <div id="tab-5" class="tab-content">
                                        <ul class="university-links">
                                            <li><a class="button medium icon fa-dollar" href="http://{$ProfilePage.Fees}" target="_blank">Fees</a></li>

                                            <li><a class="button medium icon fa-file-text-o" href="http://{$ProfilePage.Application}" target="_blank">Application</a></li>
                                            <li><a class="button medium icon fa-clock-o" href="http://{$ProfilePage.ProcessingTime}" target="_blank">Processing Time</a></li>

                                            <li><a class="button medium icon fa-edit" href="http://{$ProfilePage.EnglishRequirements}" target="_blank">English Requirements</a></li>
                                            <li><a class="button medium icon fa-book" href="http://{$ProfilePage.AdmissionRequirements}" target="_blank">Admission Requirements</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="3u 12u(2)">
                                    <h2>Static Promo Space</h2>
                                </div>
                            </div>
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </div>
</div>
            
<script src="{$ThemeDir}/javascript/tabbed.js"></script>
<script src="{$ThemeDir}/javascript/jquery.slides.min.js"></script>
<script>
    $(function() {
      $('#slides').slidesjs({
        width: 420,
        height: 315,
        navigation: {
          active: false,
          effect: "fade"
        },
        pagination: {
          effect: "fade"
        },
        effect: {
          fade: {
            speed: 400
          }
        },
        play: {
          active: true,
          auto: true,
          interval: 4000,
          effect: "fade",
          swap: true
        }
      });
    });
</script>
<script type="text/javascript">
    jQuery(".content-slider").click(function(){
        jQuery(".fa-rotate-90").removeClass("fa-rotate-90");
        if(!jQuery(this).parent().find(".hidden-content").is(":visible")) {
            jQuery(this).children().addClass("fa-rotate-90");
        }
        jQuery(".hidden-content").not(jQuery(this).parent().find(".hidden-content")).slideUp(750);
        jQuery(this).parent().find(".hidden-content").slideToggle(750);
    });
</script> 
<% include EmptyFooter %>