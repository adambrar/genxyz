<% include EmptyHeader %>
<div id="academics" class="jumbotron">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
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
                                <div class="col-sm-4 col-xs-offset-1">$FilterAcademics</div>
                                <div class="col-sm-6 col-sm-offset-1 hidden-xs">
                                    <h3 class="wow fadeInRight hidden-xs" data-wow-delay="100ms">Find the academic institution that suits you the best!</h3><br/>
                                    <img class="img-responsive wow fadeInRight" data-wow-delay="300ms" src="$ThemeDir/images/searchpage/uni.jpg" />
                                </div>
                            </div>         
                        </div>
                        <div class="tab-pane fade" id="agent">
                            <div class="row">
                                <div class="col-sm-4 col-xs-offset-1">$FilterAgents</div>
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
<div id="content">
    <div class="container margin-bottom">
        <div id="results" class="row">
            <h1 class="text-center">Results</h1>
            <div class="col-sm-3 wow fadeInRight">
                <h3>Updates</h3>
                $Updates
                <% loop Parameters %>
                    $Title test
                <% end_loop %>
            </div>
            <div id="results-section" class="col-sm-6 wow fadeInLeft">
                <% if PaginatedResults %>
                     <% if PaginatedResults.MoreThanOnePage %><div class="pagination-wrapper text-right" data-pagination-pages="{$PaginatedResults.TotalPages}" data-search-type="{$SearchType}"></div><% end_if %>
                    <% loop PaginatedResults %>
                        <div class="panel panel-primary wow fadeInRight" data-wow-delay="<% if Pos < 5 %>{$Pos}<% else %>3<% end_if %>00ms">
                        <a href="$showProfilePageLink($ID)">
                            <% if BusinessLogo %><img class="img-responsive img-thumbnail partner-logo pull-left" style="height:5em;" src="{$BaseHref}{$BusinessLogo.Filename}" alt="Logo" /><% end_if %>
                            <h4 class="panel-heading">$BusinessName</h4>
                            <p class="panel-body">$PartnersProfile.MisionStatement</p>
                        </a>
                        </div>
                    <% end_loop %>
                    <% if PaginatedResults.MoreThanOnePage %><div class="pagination-wrapper text-right" data-pagination-pages="{$PaginatedResults.TotalPages}" data-search-type="{$SearchType}"></div><% end_if %>
                <% else %>
                <p>Select search parameters to see results.</p>
                <% end_if %>
            </div>
            
            <div class="col-sm-3 wow fadeInLeft">
                <h1>Sponsored Content</h1>        
            </div>
        </div>
    </div>
</div>
                
