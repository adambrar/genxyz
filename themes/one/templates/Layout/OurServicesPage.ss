<% include EmptyHeader %>
<section id="services" class="margin-top margin-bottom" style="padding:0px;">
    <div class="container">
        <% with Page(home) %>
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
        <% end_with %>
    </div><!--/.container-->
</section><!--/#services-->