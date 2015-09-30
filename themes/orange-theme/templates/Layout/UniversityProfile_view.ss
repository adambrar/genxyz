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
                                    <div class="row small-content-box">
                                        <div class="3u gutters-fix"><% if Member.BusinessLogo %><div style="margin:10px;"><a href="http://{$Member.BusinessWebsite}" class="image fit"><img style="max-height:10em;max-width:10em" src="{$BaseHref}{$Member.BusinessLogo.Filename()}" alt="Logo" /></a></div><% end_if %></div>
                                        <div class="9u gutters-fix">
                                            <h2><a href="">$Member.BusinessName</a></h2>
                                            <h1>~Member.Tagline</h1>
                                        </div>
                                    </div>
                                    <ul class="tabs">
                                        <li class="tab-link current" data-tab="tab-1">Home</li>
                                        <li class="tab-link" data-tab="tab-2">About</li>
                                        <li class="tab-link" data-tab="tab-3">Academic Programs</li>
                                        <li class="tab-link" data-tab="tab-4" style="white-space:nowrap">Partners</li>
                                        <li class="tab-link" data-tab="tab-5" style="white-space:nowrap">Scholarships</li>
                                        <li class="tab-link" data-tab="tab-6">Contact</li>
                                        <li id="search-bar" data-tab="tab-7"><span style="font-weight:800">Application Process</span></li>
                                    </ul>
                                    <%-- HOME CONTENT --%>
                                    <div id="tab-1" class="tab-content current">
                                        <div class="row">
                                            <div class="6u 12u(1)">
                                                <iframe src="$ProfilePage.WelcomeVideoLink" width="420" height="315" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
                                            </div>
                                            <div class="6u 12u(2)">
                                                <div class="slides-container">
                                                    <div id="slides">
                                                      <img src="{$ProfilePage.SlideOne.Filename()}" alt="Photo by: Missy S Link: http://www.flickr.com/photos/listenmissy/5087404401/">
                                                      <img src="{$ProfilePage.SlideTwo.Filename()}" alt="Photo by: Daniel Parks Link: http://www.flickr.com/photos/parksdh/5227623068/">
                                                      <img src="{$ProfilePage.SlideThree.Filename()}" alt="Photo by: Mike Ranweiler Link: http://www.flickr.com/photos/27874907@N04/4833059991/">
                                                      
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
                                                <p><i class="fa fa-quote-left fa-pull-left"></i> I learned about GenXYZ through a friend. The scholarship opportunities are what appealed to me the most. GenXYZ gave me the opportunity to study at one of the best universities in Canada. <i class="fa fa-quote-right fa-pull-right"></i></p>
                                                <h1 style="text-align:right" class="testimonial-author">- Adam Brar<br/><span style="font-weight:200">Mentor</span></h1>
                                                
                                            </div>
                                            <div class="4u testimonial">
                                                <p><i class="fa fa-quote-left fa-pull-left"></i> GenXYZ helped me connect with other international students who shared many of my experiences. Living abroad isn't easy. So, it was nice to connect with others who understood my struggles and who gave me advice. <i class="fa fa-quote-right fa-pull-right"></i></p>
                                                <h1 style="text-align:right" class="testimonial-author">- Carman Lam</h1>
                                            </div>
                                            <div class="4u testimonial">
                                                <p><i class="fa fa-quote-left fa-pull-left"></i> I was able to find helpful resources through GenXYZ. It's often hard to find resources for international student. GenXYZ linked me to so many resources at once! <i class="fa fa-quote-right fa-pull-right"></i></p>
                                                <h1 style="text-align:right;" class="testimonial-author">- Nelly Young<br/><span style="font-weight:200">Student</span></h1>
                                            </div>
                                        </div>
                                    </div>
                                    <%-- ABOUT --%>
                                    <div id="tab-2" class="tab-content">
                                        <h1>Vision</h1>
                                        $ProfilePage.Vision
                                        <h1>Mission Statement</h1>
                                        $ProfilePage.MissionStatement
                                        <h1>Values</h1>
                                        $ProfilePage.Values
                                    </div>
                                    <%-- ACADEMIC PROGRAMS --%>
                                    <div id="tab-3" class="tab-content">
                                        <div id="university-programs">
                                            <% loop $Member.Programs() %>
                                                <div class="slider-content">
                                                    <h1 class="content-slider"><i class="fa fa-arrow-circle-right fa-fw fa-2x"></i>$ProgramName.Name</h1>
                                                    <div class="hidden-content">
                                                        <ul>
                                                            <% if CertificateLink %><li><i class="fa fa-hand-o-right"></i> <a href="#">Certificate</a></li><% end_if %>
                                                            <% if DiplomaLink %><li><i class="fa fa-hand-o-right"></i> <a href="#">Diploma</a></li><% end_if %>
                                                            <% if DegreeLink %><li><i class="fa fa-hand-o-right"></i> <a href="#">Degree</a></li><% end_if %>
                                                            <% if MastersLink %><li><i class="fa fa-hand-o-right"></i> <a href="#">Masters</a></li><% end_if %>
                                                            <% if DoctorateLink %><li><i class="fa fa-hand-o-right"></i> <a href="#">Doctorate</a></li><% end_if %>
                                                        </ul>
                                                    </div>
                                                </div>
                                            <% end_loop %>
                                        </div>
                                    </div>
                                    <%-- PARTNERS CONTENT --%>
                                    <div id="tab-4" class="tab-content">
                                        Partnered Schools:
                                        <ul>
                                        <% loop Member.Schools %>
                                            <li>$BusinessName</li>
                                        <% end_loop %>
                                        </ul>
                                        Recommended Agencies:
                                        <ul>
                                        <% loop Member.Agents %>
                                            <li>$BusinessName</li>
                                        <% end_loop %>
                                        </ul>
                                    </div>
                                    <%-- SCHOLARSHIPS --%>
                                    <div id="tab-5" class="tab-content">
                                        $ProfilePage.Scholarships
                                    </div>
                                    <%-- CONTACT --%>
                                    <div id="tab-6" class="tab-content" style="padding: 1em 4em;">
                                        $ProfilePage.ContactInfo
                                    </div>
                                    <%-- APPICATION PROCESS --%>
                                    <div id="tab-7" class="tab-content">
                                        <div class="6u -3u">
                                        <ul id="university-links">
                                            <li><a class="button medium icon fa-dollar" href="http://{$ProfilePage.Fees}" target="_blank">Fees</a></li>

                                            <li><a class="button medium icon fa-file-text-o" href="http://{$ProfilePage.Application}" target="_blank">Apply Now</a></li>
                                            <li><a class="button medium icon fa-clock-o" href="http://{$ProfilePage.ProcessingTime}" target="_blank">Processing Time</a></li>

                                            <li><a class="button medium icon fa-edit" href="http://{$ProfilePage.EnglishRequirements}" target="_blank">English Requirements</a></li>
                                            <li><a class="button medium icon fa-book" href="http://{$ProfilePage.AdmissionRequirements}" target="_blank">Admission Requirements</a></li>
                                        </ul>
                                        </div>
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