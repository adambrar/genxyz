<% include EmptyHeader %>
<div id="content">
    <div class="container margin-bottom">
        <div class="wow fadeInLeft">
            <div class="row">
                <div class="col-xs-1"><% if Member.BusinessLogo %><img class="img-responsive img-thumbnail partner-logo" src="{$BaseHref}{$Member.BusinessLogo.Filename}" alt="Logo" /><% end_if %></div>
                <div class="col-xs-10"><h2>$Member.BusinessName</h2></div>
            </div>
        </div>
        <% include SessionMessage %>
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#first">Home</a></li>
            <li><a data-toggle="tab" href="#second">About</a></li>
            <li><a data-toggle="tab" href="#service">Services</a></li>
            <li><a data-toggle="tab" href="#contact">Contact</a></li>
        </ul>

        <div class="tab-content">
            <div id="first" class="tab-pane fade in active">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="responsive-video"><iframe src="$ProfilePage.WelcomeVideoLink" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe></div></div>
                    <div class="col-sm-6">
                        <div id="myCarousel" class="carousel slide" data-ride="carousel">
                            <!-- Indicators -->
                            <ol class="carousel-indicators">
                              <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                              <li data-target="#myCarousel" data-slide-to="1"></li>
                              <li data-target="#myCarousel" data-slide-to="2"></li>
                              <li data-target="#myCarousel" data-slide-to="3"></li>
                            </ol>

                            <!-- Wrapper for slides -->
                            <div class="carousel-inner" role="listbox">

                              <div class="item active">
                                <img src="$ProfilePage.SlideOne.Filename()" alt="Chania">
                              </div>

                              <div class="item">
                                <img src="$ProfilePage.SlideTwo.Filename()" alt="Chania">
                             </div>

                              <div class="item">
                                <img src="$ProfilePage.SlideThree.Filename()" alt="Flower">
                             </div>

                              <div class="item">
                                <img src="$ThemeDir/images/portfolio/01.jpg" alt="Flower">
                              </div>

                            </div>

                            <!-- Left and right controls -->
                            <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                              <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                              <span class="sr-only">Previous</span>
                            </a>
                            <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                              <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                              <span class="sr-only">Next</span>
                            </a>
                          </div>
                    </div>
                </div>
            </div>
            <div id="second" class="tab-pane fade">
                <div class="row">
                    <div class="col-sm-4 wow fadeInRight" data-wow-delay="0ms">
                        <h2>Mission Statement</h2>
                        $ProfilePage.MissionStatement
                    </div>
                    <div class="col-sm-4 wow fadeInRight" data-wow-delay="200ms">
                        <h2>Vision</h2>
                        $ProfilePage.Vision
                    </div>
                    <div class="col-sm-4 wow fadeInRight" data-wow-delay="400ms">
                        <h2>Values</h2>
                        $ProfilePage.Values
                    </div>
                </div>
            </div>
            <div id="service" class="tab-pane fade">
                <div class="row">
                    <% loop Member.Services() %>
                        <div class="col-md-4 col-sm-6 wow fadeInUp" data-wow-duration="300ms" data-wow-delay="100ms">
                            <div class="media service-box">
                                <div class="pull-left">
                                    <i class="fa fa-cube"></i>
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading">$ServiceName.Name</h4>
                                    <p>$Description</p>
                                </div>
                            </div>
                        </div><!--/.col-md-4-->
                    <% end_loop %>
                </div>
            </div>
            <div id="contact" class="tab-pane fade">
                <div class="wow fadeInUp">
                    $ProfilePage.ContactInfo
                </div>
            </div>
        </div>
        </div>
    </div>
</div>