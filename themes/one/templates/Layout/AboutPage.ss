<% include EmptyHeader %>
<section id="about" class="margin-top margin-bottom" style="padding:0px;">
    <div class="container">
        <% with Page(home) %>
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
        <% end_with %>        
    </div>
</section><!--/#about-->

