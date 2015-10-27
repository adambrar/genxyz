<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>GenXYZ | Homepage</title>
	<!-- core CSS -->
    <link href="$ThemeDir/test/css/bootstrap.min.css" rel="stylesheet">
    <link href="$ThemeDir/test/css/font-awesome.min.css" rel="stylesheet">
    <link href="$ThemeDir/test/css/animate.min.css" rel="stylesheet">
    <link href="$ThemeDir/test/css/owl.carousel.css" rel="stylesheet">
    <link href="$ThemeDir/test/css/owl.transitions.css" rel="stylesheet">
    <link href="$ThemeDir/test/css/prettyPhoto.css" rel="stylesheet">
    <link href="$ThemeDir/test/css/main.css" rel="stylesheet">
    <link href="$ThemeDir/test/css/responsive.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="$ThemeDir/test/javascript/html5shiv.js"></script>
    <script src="$ThemeDir/test/javascript/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
</head><!--/head-->

<body id="home" class="homepage">

    <header id="header">
        <nav id="main-menu" class="navbar navbar-default navbar-fixed-top" role="banner">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href=""><h2 style="font-family:'Lucida Console', Monaco, monospace;color:white;">GenXYZ</h2></a>
                </div>
				
                <div class="collapse navbar-collapse navbar-right">
                    <ul class="nav navbar-nav">
                        <li class="scroll active"><a href="#home">Home</a></li>
                        <li class="scroll"><a href="#about">About</a></li>
                        <li class="scroll"><a href="#services">Services</a></li>
                        <li class="scroll"><a href="#blog">Blog</a></li> 
                        <li class="scroll"><a href="#get-in-touch">Contact</a></li>
                        <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown">Login</a>
                            <ul class="dropdown-menu">
                                <li>$LoginForm</li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div><!--/.container-->
        </nav><!--/nav-->
    </header><!--/header-->

    <section id="main-slider">
        <div class="owl-carousel">
            <div class="item" style="background-image: url($ThemeDir/test/images/slider/bg1.jpg);">
                <div class="slider-inner">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-7">
                                <div class="carousel-content wow fadeInUp">
                                    <h2><span>GenXYZ</span>  $WelcomeTitle</h2>
                                    <p>$WelcomeMessage</p>
                                    <div class="row">
                                        <div class="col-xs-4">
                                            <a class="btn btn-primary btn-lg tohash" href="#about">Read More</a>
                                        </div>
                                        <div class="col-xs-4">
                                            <a class="btn btn-primary btn-lg tohash" href="#services">Students</a>
                                        </div>
                                        <div class="col-xs-4">
                                            <a class="btn btn-primary btn-lg tohash" href="#services">Partners</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!--/.item-->
             <div class="item" style="background-image: url($ThemeDir/test/images/slider/bg2.jpg);">
                <div class="slider-inner">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-7">
                                <div class="carousel-content">
                                    <h2><span>GenXYZ</span>  $WelcomeTitle</h2>
                                    <p>$WelcomeMessage</p>
                                    <div class="row">
                                        <div class="col-xs-4">
                                            <a class="btn btn-primary btn-lg tohash" href="#about">Read More</a>
                                        </div>
                                        <div class="col-xs-4">
                                            <a class="btn btn-primary btn-lg tohash" href="#services">Students</a>
                                        </div>
                                        <div class="col-xs-4">
                                            <a class="btn btn-primary btn-lg tohash" href="#services">Partners</a>
                                        </div>
                                    </div>                                
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!--/.item-->
        </div><!--/.owl-carousel-->
    </section><!--/#main-slider-->

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
                <h2 class="section-title text-center wow fadeInDown">Our Services</h2>
                <p class="text-center wow fadeInDown">$ServicesMessage</p>
            </div>

            <div class="row">
                <div class="features">
                    <div class="col-md-4 col-sm-6 wow fadeInUp" data-wow-duration="300ms" data-wow-delay="0ms">
                        <div class="media service-box">
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
                        <div class="media service-box">
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
                        <div class="media service-box">
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
                        <div class="media service-box">
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
                        <div class="media service-box">
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
                        <div class="media service-box">
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

    <section id="testimonial">
        <div class="container">
            <h2 class="text-center wow fadeIn" style="color:white;">Testimonials</h2>
            <div class="row">
                <div class="col-sm-8 col-sm-offset-2">

                    <div id="carousel-testimonial" class="carousel slide text-center" data-ride="carousel">
                        <!-- Wrapper for slides -->
                        <div class="carousel-inner" role="listbox">
                            <div class="item active">
                                <p><img class="img-circle img-thumbnail" src="$ThemeDir/test/images/testimonial/01.jpg" alt=""></p>
                                <h4>Louise S. Morgan</h4>
                                <small>Treatment, storage, and disposal (TSD) worker</small>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut et dolore magna aliqua. Ut enim ad minim veniam</p>
                            </div>
                            <div class="item">
                                <p><img class="img-circle img-thumbnail" src="$ThemeDir/test/images/testimonial/01.jpg" alt=""></p>
                                <h4>Louise S. Morgan</h4>
                                <small>Treatment, storage, and disposal (TSD) worker</small>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut et dolore magna aliqua. Ut enim ad minim veniam</p>
                            </div>
                        </div>

                        <!-- Controls -->
                        <div class="btns">
                            <a class="btn btn-primary btn-sm" href="#carousel-testimonial" role="button" data-slide="prev">
                                <span class="fa fa-angle-left" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="btn btn-primary btn-sm" href="#carousel-testimonial" role="button" data-slide="next">
                                <span class="fa fa-angle-right" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><!--/#testimonial-->

    <section id="blog">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title text-center wow fadeInDown">Latest Blogs</h2>
                <p class="text-center wow fadeInDown">$BlogMessage</p>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <div class="blog-post blog-large wow fadeInLeft" data-wow-duration="300ms" data-wow-delay="0ms">
                        <article>
                            <% with LatestBlogPost(1) %>
                                <header class="entry-header">
                                    <div class="entry-thumbnail">
                                        <img class="img-responsive" src="$ThemeDir/test/images/blog/01.jpg" alt="">
                                        <span class="post-format post-format-video"><i class="fa fa-film"></i></span>
                                    </div>
                                    <div class="entry-date">$Date.Format('d F Y')</div>
                                    <h2 class="entry-title"><a href="$Link">$Title</a></h2>
                                </header>

                                <div class="entry-content">
                                    <P>$Content.LimitCharacters(300)</P>
                                    <a class="btn btn-primary" href="$Link">Read More</a>
                                </div>

                                <footer class="entry-meta">
                                    <% if authorName %><span class="entry-author"><i class="fa fa-pencil"></i> <a href="{$authorProfileURL($BlogHolder.OwnerID)}">$authorName</a></span><% end_if %>
                                    <% if Topic %><span class="entry-category"><i class="fa fa-folder-o"></i> <a href="{$Topic.Link}">$Topic.Title</a></span><% end_if %>
                                    <span class="entry-comments"><i class="fa fa-comments-o"></i> <a href="$Link#PageComments_holder">$Comments.Count</a></span>
                                </footer>
                            <% end_with %>
                        </article>
                    </div>
                </div><!--/.col-sm-6-->
                <div class="col-sm-6">
                    <div class="blog-post blog-media wow fadeInRight" data-wow-duration="300ms" data-wow-delay="100ms">
                        <article class="media clearfix">
                            <% with LatestBlogPost(2) %>
                                <div class="entry-thumbnail pull-left">
                                    <img class="img-responsive" src="$ThemeDir/test/images/blog/02.jpg" alt="">
                                    <span class="post-format post-format-gallery"><i class="fa fa-image"></i></span>
                                </div>
                                <div class="media-body">
                                    <header class="entry-header">
                                        <div class="entry-date">$Date.Format('d F Y')</div>
                                        <h2 class="entry-title"><a href="#">$Title</a></h2>
                                    </header>

                                    <div class="entry-content">
                                        <P>$Content.LimitCharacters(200)</P>
                                        <a class="btn btn-primary" href="$Link">Read More</a>
                                    </div>

                                    <footer class="entry-meta">
                                        <span class="entry-author"><i class="fa fa-pencil"></i> <a href="$authorProfileURL($BlogHolder.OwnerID)">$authorName</a></span>
                                        <span class="entry-category"><i class="fa fa-folder-o"></i> <a href="$Topic.Link">$Topic.Title</a></span>
                                        <span class="entry-comments"><i class="fa fa-comments-o"></i> <a href="$Link#PageComments_holder">$Comments.Count</a></span>
                                    </footer>
                                </div>
                            <% end_with %>
                        </article>
                    </div>
                    <div class="blog-post blog-media wow fadeInRight" data-wow-duration="300ms" data-wow-delay="200ms">
                        <article class="media clearfix">
                            <% with LatestBlogPost(3) %>
                                <div class="entry-thumbnail pull-left">
                                    <img class="img-responsive" src="$ThemeDir/test/images/blog/03.jpg" alt="">
                                    <span class="post-format post-format-audio"><i class="fa fa-music"></i></span>
                                </div>
                                <div class="media-body">
                                    <header class="entry-header">
                                        <div class="entry-date">$Date.Format('d F Y')</div>
                                        <h2 class="entry-title"><a href="$Link">$Title</a></h2>
                                    </header>

                                    <div class="entry-content">
                                        <P>$Content.LimitCharacters(200)</P>
                                        <a class="btn btn-primary" href="$Link">Read More</a>
                                    </div>

                                    <footer class="entry-meta">
                                        <% if authorName %><span class="entry-author"><i class="fa fa-pencil"></i> <a href="{$authorProfileURL($BlogHolder.OwnerID)}">$authorName</a></span><% end_if %>
                                        <span class="entry-category"><i class="fa fa-folder-o"></i> <a href="$Topic.Link">$Topic.Title</a></span>
                                        <span class="entry-comments"><i class="fa fa-comments-o"></i> <a href="$Link#PageComments_holder">$Comments.Count</a></span>
                                    </footer>
                                </div>
                            <% end_with %>
                        </article>
                    </div>
                </div>
            </div>

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

    <footer id="footer">
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    Special Thanks To<br>
                    Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old.
                </div>
                <div class="col-sm-4">
                    Highlight of the Month<br>
                    Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source.
                </div>
                <div class="col-sm-4">
                    Scholarships<br>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    &copy; 2015 GenXYZ. Designed by <a target="_blank" href="http://adambrar.com/" title="Web Development and Hosting">Adam Brar</a>
                </div>
                <div class="col-sm-6">
                    <ul class="social-icons">
                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                        <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
                        <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                        <li><a href="#"><i class="fa fa-behance"></i></a></li>
                        <li><a href="#"><i class="fa fa-flickr"></i></a></li>
                        <li><a href="#"><i class="fa fa-youtube"></i></a></li>
                        <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                        <li><a href="#"><i class="fa fa-github"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer><!--/#footer-->

    <script src="$ThemeDir/test/javascript/jquery.js"></script>
    <script src="$ThemeDir/test/javascript/bootstrap.min.js"></script>
    <script src="http://maps.google.com/maps/api/js?sensor=true"></script>
    <script src="$ThemeDir/test/javascript/owl.carousel.min.js"></script>
    <script src="$ThemeDir/test/javascript/mousescroll.js"></script>
    <script src="$ThemeDir/test/javascript/smoothscroll.js"></script>
    <script src="$ThemeDir/test/javascript/jquery.prettyPhoto.js"></script>
    <script src="$ThemeDir/test/javascript/jquery.isotope.min.js"></script>
    <script src="$ThemeDir/test/javascript/jquery.inview.min.js"></script>
    <script src="$ThemeDir/test/javascript/wow.min.js"></script>
    <script src="$ThemeDir/test/javascript/main.js"></script>
</body>
</html>