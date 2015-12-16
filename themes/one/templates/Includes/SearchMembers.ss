<div id="academics" class="jumbotron">
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="">
                    <% include SessionMessage %>
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#school" data-toggle="tab"><i class="fa fa-institution"></i> Schools</a></li>
                        <li><a href="#agent" data-toggle="tab"><i class="fa fa-user"></i> Agents</a></li>
                        <li><a href="#homestay" data-toggle="tab"><i class="fa fa-home"></i> Accommodation</a></li>
                        <li><a href="#mentor" data-toggle="tab"><i class="fa fa-users"></i> Student Mentors</a></li>
                    </ul>
                    <div id="academics-search-content" class="tab-content">
                        <h3 class="text-center">Search for whatever you need.</h3>
                        <div class="tab-pane active in fade" id="school">
                            <div class="row">
                                <div class="col-sm-4 col-xs-offset-1">$Top.FilterSchools</div>
                                <div class="col-sm-6 col-sm-offset-1 hidden-xs">
                                    <h3 class="wow fadeInRight hidden-xs" data-wow-delay="100ms">Find the academic institution that suits you the best!</h3><br/>
                                    <img class="img-responsive wow fadeInRight" data-wow-delay="300ms" src="$ThemeDir/images/searchpage/uni.jpg" />
                                </div>
                            </div>         
                        </div>
                        <div class="tab-pane fade" id="agent">
                            <div class="row">
                                <div class="col-sm-4 col-xs-offset-1">$Top.FilterAgents</div>
                                <div class="col-xs-6 col-sm-offset-1 hidden-xs">
                                    <h3 class="wow fadeInRight hidden-xs" data-wow-delay="100ms">Agents are waiting to help you with anything you might need. Search for one in your region.</h3><br/>
                                    <img class="img-responsive wow fadeInRight" data-wow-delay="300ms" src="$ThemeDir/images/searchpage/agent.jpg" />
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="homestay">
                            <div class="row">
                                <div class="col-sm-4 col-xs-offset-1">$FilterAccomodations</div>
                                <div class="col-sm-6 col-sm-offset-1 hidden-xs">
                                    <h3 class="wow fadeInRight hidden-xs" data-wow-delay="100ms">Find a place to live wherever you are going!</h3><br/>
                                    <img class="img-responsive wow fadeInRight" data-wow-delay="300ms" src="$ThemeDir/images/searchpage/house.jpg" />
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="mentor">
                            <div class="row">
                                <div class="col-sm-4 col-xs-offset-1">$FilterMentors</div>
                                <div class="col-sm-6 col-sm-offset-1 hidden-xs">
                                    <h3 class="wow fadeInRight" data-wow-delay="100ms">Mentors are available to help you out with anything and everything.</h3><br/>
                                    <img class="img-responsive wow fadeInRight" data-wow-delay="300ms" src="$ThemeDir/images/searchpage/uni.jpg" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>