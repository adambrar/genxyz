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
                                        <div class="2u -1u gutters-fix"><% if Logo %><div style="margin:10px;"><a href="http://{$Member.BusinessWebsite}" class="image fit"><img style="max-height:10em;max-width:10em" src="{$BaseHref}{$Logo.Filename}" alt="Logo" /></a></div><% end_if %></div>
                                        <div class="6u gutters-fix">
                                            <div class="small-content-box">
                                                <h2><a href="">GenXYZ</a></h2>
                                                <h1>~Tomorrow start today</h1>
                                            </div>
                                        </div>
                                        <div class="2u gutters-fix"><% if Logo %><div style="margin:10px;"><a href="http://{$Member.BusinessWebsite}" class="image fit"><img style="max-height:10em;max-width:10em" src="{$BaseHref}{$Logo.Filename}" alt="Logo" /></a></div><% end_if %></div>
                                    </div>
                                    <ul class="tabs">
                                        <li class="tab-link current" data-tab="tab-1">Home</li>
                                        <li class="tab-link" data-tab="tab-2">About</li>
                                        <li class="tab-link" data-tab="tab-3">Academic Programs</li>
                                        <li class="tab-link" data-tab="tab-4" style="white-space:nowrap">Tuition</li>
                                        <li class="tab-link" data-tab="tab-5" style="white-space:nowrap">Scholarships</li>
                                        <li class="tab-link" data-tab="tab-6">Contact</li>
                                        <li id="search-bar" data-tab="tab-7"><span style="font-weight:800">Application Process</span></li>
                                    </ul>
                                    <%-- HOME --%>
                                    <div id="tab-1" class="tab-content current">
                                        <div class="row">
                                            <div class="6u 12u(1)">
                                                <iframe width="420" height="315"
src="http://www.youtube.com/embed/XGSy3_Czz8k?showinfo=0"></iframe>
                                                <iframe src="https://player.vimeo.com/video/137334520" width="420" height="315" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
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
                                        <h1>Mission Statement</h1>
                                        <p>GenXYZ is a platform dedicated to revolutionizing education by bridging gaps to achieve fairness and accessibility.</p>
                                        <h1>Values</h1>
                                        <p>Promote global education by facilitating the exchange of intercultural perspectives and providing access to international student services.</p>
                                        <h1>Vision</h1>
                                        <p>Genxyz is committed to the following:
                                        <ul>
                                            <li>Integrity</li>
                                            <li>Innovation</li>
                                            <li>Inclusion</li>
                                            <li>Harmony</li>
                                        </ul>
                                        </p>
                                    </div>
                                    <%-- ACADEMIC PROGRAMS --%>
                                    <div id="tab-3" class="tab-content">
                                        List of academic programs in alphabetic order.
                                        <div id="university-programs">
                                            <div class="slider-content">
                                                <h1 class="content-slider"><i class="fa fa-arrow-circle-right fa-fw fa-2x"></i>Nursing</h1>
                                                <div class="hidden-content">
                                                    <ul>
                                                        <li><i class="fa fa-hand-o-right"></i> <a href="#">Certificate</a></li>
                                                        <li><i class="fa fa-hand-o-right"></i> <a href="#">Diploma</a></li>
                                                        <li><i class="fa fa-hand-o-right"></i> <a href="#">Degree</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="slider-content">
                                                <h1 class="content-slider"><i class="fa fa-arrow-circle-right fa-fw fa-2x"></i>Engineering</h1>
                                                <div class="hidden-content">
                                                    <ul>
                                                        <li><i class="fa fa-hand-o-right"></i> <a href="#">Degree</a></li>
                                                        <li><i class="fa fa-hand-o-right"></i> <a href="#">Masters</a></li>
                                                        <li><i class="fa fa-hand-o-right"></i> <a href="#">Doctorate</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="slider-content">
                                                <h1 class="content-slider"><i class="fa fa-arrow-circle-right fa-fw fa-2x"></i>Sociology</h1>
                                                <div class="hidden-content">
                                                    <ul>
                                                        <li><i class="fa fa-hand-o-right"></i> <a href="#">Diploma</a></li>
                                                        <li><i class="fa fa-hand-o-right"></i> <a href="#">Degree</a></li>
                                                        <li><i class="fa fa-hand-o-right"></i> <a href="#">Masters</a></li>
                                                        <li><i class="fa fa-hand-o-right"></i> <a href="#">Doctorate</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="slider-content">
                                                <h1 class="content-slider"><i class="fa fa-arrow-circle-right fa-fw fa-2x"></i>Philosophy</h1>
                                                <div class="hidden-content">
                                                    <ul>
                                                        <li><i class="fa fa-hand-o-right"></i> <a href="#">Certificate</a></li>
                                                        <li><i class="fa fa-hand-o-right"></i> <a href="#">Diploma</a></li>
                                                        <li><i class="fa fa-hand-o-right"></i> <a href="#">Degree</a></li>
                                                        <li><i class="fa fa-hand-o-right"></i> <a href="#">Masters</a></li>
                                                        <li><i class="fa fa-hand-o-right"></i> <a href="#">Doctorate</a></li>
                                                    </ul>
                                                </div>
                                            </div>                                            
                                            <div class="slider-content">
                                                <h1 class="content-slider"><i class="fa fa-arrow-circle-right fa-fw fa-2x"></i>Pharmacy</h1>
                                                <div class="hidden-content">
                                                    <ul>
                                                        <li><i class="fa fa-hand-o-right"></i> <a href="#">Degree</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <%-- TUITION --%>
                                    <div id="tab-4" class="tab-content">
                                        <style type="text/css">
                                            .tg  {border-collapse:collapse;border-spacing:0;}
                                            .tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
                                            .tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
                                            .tg .tg-q7u4{background-color:#00009b;color:#ffffff}
                                            .tg .tg-0a3w{background-color:#68cbd0}
                                            .tg .tg-c7d0{background-color:#bbdaff}
                                            .tg .tg-36xf{font-weight:bold;background-color:#bbdaff}
                                            </style>
                                            <table class="tg">
                                              <tr>
                                                <th class="tg-q7u4"></th>
                                                <th class="tg-q7u4">Credits</th>
                                                <th class="tg-q7u4">Canadian Citizen or<br>Permanent Resident</th>
                                                <th class="tg-q7u4">Internation Students</th>
                                              </tr>
                                              <tr>
                                                <td class="tg-0a3w">Arts</td>
                                                <td class="tg-0a3w"><br>30</td>
                                                <td class="tg-0a3w">4,898.83</td>
                                                <td class="tg-0a3w">26,532.92</td>
                                              </tr>
                                              <tr>
                                                <td class="tg-c7d0">Commerce</td>
                                                <td class="tg-c7d0">30</td>
                                                <td class="tg-c7d0">7,684.62</td>
                                                <td class="tg-c7d0">30,208.93</td>
                                              </tr>
                                              <tr>
                                                <td class="tg-0a3w">Applied Science</td>
                                                <td class="tg-0a3w">35</td>
                                                <td class="tg-0a3w">6,321.84</td>
                                                <td class="tg-0a3w">31,098.31</td>
                                              </tr>
                                              <tr>
                                                <td class="tg-c7d0">Science</td>
                                                <td class="tg-c7d0">30</td>
                                                <td class="tg-c7d0">5,246.60</td>
                                                <td class="tg-c7d0">27,329.29</td>
                                              </tr>
                                              <tr>
                                                <td class="tg-0a3w">Living costs, books and student fees</td>
                                                <td class="tg-0a3w"></td>
                                                <td class="tg-0a3w">13,000-15,000</td>
                                                <td class="tg-0a3w">13,000-15,000</td>
                                              </tr>
                                              <tr>
                                                <td class="tg-36xf">Total (CAD$)</td>
                                                <td class="tg-c7d0"></td>
                                                <td class="tg-36xf">19,000-24,000</td>
                                                <td class="tg-36xf">39,000-46,000</td>
                                              </tr>
                                            </table>
                                    </div>
                                    <%-- SCHOLARSHIPS --%>
                                    <div id="tab-5" class="tab-content">
                                        <p>International students are invaluable to GenXYZ. We realize that finances are a challenge sometimes and we do our best to help those hard-working, talented students financial help and resources. GenXYZ offers a full and partial scholarships. Scholarships are awarded on a need basis as well as on merit.</p>
                                        <h1>GenXYZ Fund for Change Merit-based Scholarship</h1>
                                        <p>This scholarship is designed for students currently attending one of our partner institutions and are showing promise. These students are actively working or volunteering in the community to enable positive change. See further eligibility requirements for this scholarship.</p>
                                        <h1>GenXYZ Fund for Change Entrance Scholarship</h1>
                                        <p>This scholarship is designed for recent secondary school graduates. Students must have graduated from one of our partner secondary schools and must have gained admission into one the selected programs at a post-secondary partner institution. See eligibility requirements for this scholarship.</p>
                                    </div>
                                    <%-- CONTACT --%>
                                    <div id="tab-6" class="tab-content" style="padding: 1em 4em;">
                                        <p>Documents required for undergraduate applications should be mailed to the address below and must be <strong>sealed</strong> and <strong>sent directly</strong> from the secondary school. All documents should be <strong>translated</strong> whenever possible. Appropriate documents must be <strong>signed and dated.</strong></p>
                                        <h1>Undergraduate Admissions</h1>
                                        <ul>
                                            <li>1234 Fake Street</li>
                                            <li>Vancouver, Yukon</li>
                                            <li>Canada</li>
                                            <li>Y0A 1W0</li>
                                        </ul>
                                        <h1>Graduate Admissions</h1>
                                        <ul>
                                            <li>3358 Notfake Street</li>
                                            <li>Vancouver, BC</li>
                                            <li>Canada</li>
                                            <li>Y0A 1W0</li>
                                        </ul>
                                        <h1>Undergraduate Enrolment</h1>
                                        <ul>
                                            <li>1234 Ekafton Avenue</li>
                                            <li>Vancouver, Yukon</li>
                                            <li>Canada</li>
                                            <li>Y0A 1W0</li>
                                        </ul>
                                        <h1>Graduate Enrolment</h1>
                                        <ul>
                                            <li>6854 Ekaf Street</li>
                                            <li>Vancouver, Yukon</li>
                                            <li>Canada</li>
                                            <li>Y0A 1W0</li>
                                        </ul>
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