<% include Header %>
<% include SearchMembers %>
<section id="cta" class="wow fadeIn">
    <div class="container">
        <div class="row">
            <div class="col-sm-9">
                <h2>What is GenXYZ?</h2>
                <p>$WhatIs
                </p>
            </div>
            <div class="col-sm-3 text-right">
                <a class="btn btn-primary btn-lg tohash" href="#blog">Learn More</a>
            </div>
        </div>
    </div>
</section><!--/#cta-->

<section id="about">
    <div class="container">

        <div class="section-header">
            <h2 class="section-title text-center wow fadeInDown">About Us</h2>
            <p class="text-center wow fadeInDown">$AboutUsMessage</p>
        </div>

        <div class="row">
            <div class="col-sm-6 wow fadeInLeft">
                <h3 class="column-title">Video Intro</h3>
                <!-- 16:9 aspect ratio -->
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe src="https://www.youtube.com/embed/FYJMI7PjMaA" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
                </div>
            </div>

            <div class="col-sm-6 wow fadeInRight">
                <h3 class="column-title">Vision</h3>
                <p>$AboutUsVision</p>
                <h3 class="column-title">Mission Statement</h3>
                <p>$AboutUsMissionStatement</p>
                <h3 class="column-title">Values</h3>
                <div class="row">
                    <div class="col-sm-6">
                        <ul class="nostyle">
                            <li><i class="fa fa-check-square"></i>$AboutUsValueOne</li>
                            <li><i class="fa fa-check-square"></i>$AboutUsValueTwo</li>
                        </ul>
                    </div>

                    <div class="col-sm-6">
                        <ul class="nostyle">
                            <li><i class="fa fa-check-square"></i>$AboutUsValueThree</li>
                            <li><i class="fa fa-check-square"></i>$AboutUsValueFour</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section><!--/#about-->


<section id="services" >
    <div class="container">

        <div class="section-header">
            <h2 class="section-title text-center wow fadeInDown">What We Do</h2>
            <p class="text-center wow fadeInDown">$ServicesMessage</p>
        </div>

        <div class="row">
            <div class="features match-height-boxes">
                <div class="col-md-4 col-sm-6 wow fadeInUp" data-wow-duration="300ms" data-wow-delay="0ms">
                    <div class="media service-box match-height-box">
                        <div class="pull-left">
                            <i class="fa fa-$ServiceOneIcon"></i>
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading">$ServiceOneTitle</h4>
                            <p>$ServiceOneContent</p>
                        </div>
                    </div>
                </div><!--/.col-md-4-->

                <div class="col-md-4 col-sm-6 wow fadeInUp" data-wow-duration="300ms" data-wow-delay="100ms">
                    <div class="media service-box match-height-box">
                        <div class="pull-left">
                            <i class="fa fa-$ServiceTwoIcon"></i>
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading">$ServiceTwoTitle</h4>
                            <p>$ServiceTwoContent</p>
                        </div>
                    </div>
                </div><!--/.col-md-4-->

                <div class="col-md-4 col-sm-6 wow fadeInUp" data-wow-duration="300ms" data-wow-delay="200ms">
                    <div class="media service-box match-height-box">
                        <div class="pull-left">
                            <i class="fa fa-$ServiceThreeIcon"></i>
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading">$ServiceThreeTitle</h4>
                            <p>$ServiceThreeContent</p>
                        </div>
                    </div>
                </div><!--/.col-md-4-->

                <div class="col-md-4 col-sm-6 wow fadeInUp" data-wow-duration="300ms" data-wow-delay="300ms">
                    <div class="media service-box match-height-box">
                        <div class="pull-left">
                            <i class="fa fa-$ServiceFourIcon"></i>
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading">$ServiceFourTitle</h4>
                            <p>$ServiceFourContent</p>
                        </div>
                    </div>
                </div><!--/.col-md-4-->

                <div class="col-md-4 col-sm-6 wow fadeInUp" data-wow-duration="300ms" data-wow-delay="400ms">
                    <div class="media service-box match-height-box">
                        <div class="pull-left">
                            <i class="fa fa-$ServiceFiveIcon"></i>
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading">$ServiceFiveTitle</h4>
                            <p>$ServiceFiveContent</p>
                        </div>
                    </div>
                </div><!--/.col-md-4-->

                <div class="col-md-4 col-sm-6 wow fadeInUp" data-wow-duration="300ms" data-wow-delay="500ms">
                    <div class="media service-box match-height-box">
                        <div class="pull-left">
                            <i class="fa fa-$ServiceSixIcon"></i>
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading">$ServiceSixTitle</h4>
                            <p>$ServiceSixContent</p>
                        </div>
                    </div>
                </div><!--/.col-md-4-->
            </div>
        </div><!--/.row-->    
    </div><!--/.container-->
</section><!--/#services-->
<section id="magazine">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title text-center wow fadeInDown">Magazine Posts</h2>
        </div>
        <% with LatestMagazinePost(1) %>
            <div class="row">
                <div class="col-md-8 col-md-offset-1 wow fadeInRight">
                     <h2><strong><a>$Title</a></strong></h2>

                    <p>$Content.LimitCharacters(400)</p>
                    <p><a class="btn btn-primary" href="#">Read more</a>
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <p><i class="glyphicon glyphicon-calendar"></i>$Date.Format('d F Y') | <a href="$Link#PageComments_holder"><i class="glyphicon glyphicon-comment"></i>  $Comments.Count</a> <% if Topic %>| <span class="entry-category"><i class="fa fa-folder-o"></i> <a href="$Topic.Link">$Topic.Title</a></span><% end_if %>
                    </p>
                </div>
            </div>
        <% end_with %>
        <% with LatestMagazinePost(2) %>
            <div class="row text-right">
                <div class="col-md-8 col-md-offset-3 wow fadeInRight">
                     <h2><strong><a>$Title</a></strong></h2>

                    <p>$Content.LimitCharacters(400)</p>
                    <p><a class="btn btn-primary" href="#">Read more</a>
                    </p>
                </div>
            </div>
            <div class="row text-right">
                <div class="col-md-10 col-md-offset-1">
                    <p><i class="glyphicon glyphicon-calendar"></i>$Date.Format('d F Y') | <a href="$Link#PageComments_holder"><i class="glyphicon glyphicon-comment"></i>  $Comments.Count</a> <% if Topic %>| <span class="entry-category"><i class="fa fa-folder-o"></i> <a href="$Topic.Link">$Topic.Title</a></span><% end_if %>
                    </p>
                </div>
            </div>
        <% end_with %>
        <% with LatestMagazinePost(3) %>
            <div class="row">
                <div class="col-md-8 col-md-offset-1 wow fadeInRight">
                     <h2><strong><a>$Title</a></strong></h2>

                    <p>$Content.LimitCharacters(400)</p>
                    <p><a class="btn btn-primary" href="#">Read more</a>
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <p><i class="glyphicon glyphicon-calendar"></i>$Date.Format('d F Y') | <a href="$Link#PageComments_holder"><i class="glyphicon glyphicon-comment"></i>  $Comments.Count</a> <% if Topic %>| <span class="entry-category"><i class="fa fa-folder-o"></i> <a href="$Topic.Link">$Topic.Title</a></span><% end_if %>
                    </p>
                </div>
            </div>
        <% end_with %>
        <% with LatestMagazinePost(4) %>
            <div class="row text-right">
                <div class="col-md-8 col-md-offset-3 wow fadeInRight">
                     <h2><strong><a>$Title</a></strong></h2>

                    <p>$Content.LimitCharacters(400)</p>
                    <p><a class="btn btn-primary" href="#">Read more</a>
                    </p>
                </div>
            </div>
            <div class="row text-right">
                <div class="col-md-10 col-md-offset-1">
                    <p><i class="glyphicon glyphicon-calendar"></i>$Date.Format('d F Y') | <a href="$Link#PageComments_holder"><i class="glyphicon glyphicon-comment"></i>  $Comments.Count</a> <% if Topic %>| <span class="entry-category"><i class="fa fa-folder-o"></i> <a href="$Topic.Link">$Topic.Title</a></span><% end_if %>
                    </p>
                </div>
            </div>
        <% end_with %>
        
    </div>
</section>
<section id="get-in-touch">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title text-center wow fadeInDown">Get in Touch</h2>
            <p class="text-center wow fadeInDown">$ContactMessage</p>
        </div>
        <div class="row">
                <div class="col-sm-4 col-sm-offset-4 wow fadeInUp">
                    <div class="contact-form">
                        <h3>Contact Info</h3>

                        <address>
                          <strong>$SiteConfig.Title</strong><br>
                          $SiteConfig.AddressLine1<br>
                          $SiteConfig.AddressLine2<br>
                          Phone: $SiteConfig.PhoneNumber
                        </address>
                        <strong>Or send us a message now:</strong>
                        <form id="main-contact-form" name="contact-form" method="post" action="#">
                            <div class="form-group">
                                <input type="text" name="name" class="form-control" placeholder="Name" required>
                            </div>
                            <div class="form-group">
                                <input type="email" name="email" class="form-control" placeholder="Email" required>
                            </div>
                            <div class="form-group">
                                <input type="text" name="subject" class="form-control" placeholder="Subject" required>
                            </div>
                            <div class="form-group">
                                <textarea name="message" class="form-control" rows="8" placeholder="Message" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Send Message</button>
                        </form>
                    </div>
                </div>
            </div>
    </div>
</section><!--/#get-in-touch-->