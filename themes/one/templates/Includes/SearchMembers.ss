<% with Page(search) %>
<div id="academics" class="jumbotron" style="background: url({$BackgroundImage.Filename()}) no-repeat;background-size:100% 100%;">
<% end_with %>
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <div class="">
                    <% include SessionMessage %>
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#school" data-toggle="tab"><i class="fa fa-institution"></i> Academics</a></li>
                        <li><a href="#agent" data-toggle="tab"><i class="fa fa-user"></i> Agents</a></li>
                        
                    </ul>
                    <div id="academics-search-content" class="tab-content">
                        <% with getSearchPageFilters %>    
                                <h3 class="text-center">Search for whatever you need.</h3>
                                <div class="tab-pane active in fade" id="school">
                                    $FilterSchools
                                    <h6 class="wow fadeInRight hidden-xs" data-wow-delay="100ms">Find the academic institution that suits you the best!</h6><br/>
                                </div>
                                <div class="tab-pane fade" id="agent">
                                    $FilterAgents
                                    <h6 class="wow fadeInRight hidden-xs" data-wow-delay="100ms">Agents are waiting to help you with anything you might need. Search for one in your region.</h6><br/>
                                </div>
                                <div class="tab-pane fade" id="homestay">
                                    
                                    <h6 class="wow fadeInRight hidden-xs" data-wow-delay="100ms">Find a place to live wherever you are going!</h6><br/>
                                </div>
                                <div class="tab-pane fade" id="mentor">
                                    
                                    <h6 class="wow fadeInRight" data-wow-delay="100ms">Mentors are available to help you out with anything and everything.</h6><br/>
                                </div>
                        <% end_with %>
                        <% if isHomePage %>
                            <div class="row">
                                <div class="col-xs-3 col-xs-offset-2">
                                    <a class="btn btn-primary btn-lg tohash" href="#about">Read More <i class="fa fa-arrow-down"></i></a>
                                </div>
                                <div class="col-xs-3 col-xs-offset-2">
                                    <a class="btn btn-primary btn-lg" href="student">Students <i class="fa fa-arrow-right"></i></a>
                                </div>
                            </div>
                        <% end_if %>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>