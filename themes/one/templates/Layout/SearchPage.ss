<% include EmptyHeader %>
<div id="academics" class="jumbotron">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#school" data-toggle="tab"><i class="fa fa-institution"></i> Schools</a></li>
                        <li><a href="#agent" data-toggle="tab"><i class="fa fa-user"></i> Agents</a></li>
                        <li><a href="#homestay" data-toggle="tab"><i class="fa fa-home"></i> Accommodation</a></li>
                        <li><a href="#homestay" data-toggle="tab"><i class="fa fa-users"></i> Student Mentors</a></li>
                    </ul>
                    <div id="academics-search-content" class="tab-content">
                        <div class="tab-pane active in fade" id="school">
                            $FilterAcademics         
                        </div>
                        <div class="tab-pane fade" id="agent">
                            $FilterAcademics
                        </div>
                        <div class="tab-pane fade" id="homestay">
                            $FilterAcademics
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
            </div>
            <div class="col-sm-6">
                <% loop PaginatedUniversities %>
                    <div class="panel panel-primary wow fadeInRight" data-wow-delay="<% if Pos < 5 %>{$Pos}<% else %>3<% end_if %>00ms">
                    <a href="$showProfilePageLink($ID)">
                        <% if BusinessLogo %><img class="img-responsive img-thumbnail partner-logo pull-left" style="height:5em;" src="{$BaseHref}{$BusinessLogo.Filename}" alt="Logo" /><% end_if %>
                        <h4 class="panel-heading">$BusinessName</h4>
                        <p class="panel-body">$PartnersProfile.MisionStatement</p>
                    </a>
                    </div>
                <% end_loop %>

                <% if PaginatedUniversities.MoreThanOnePage %>
                    <div class="text-center wow fadeIn">
                        <ul class="pagination">
                            <% if PaginatedUniversities.NotFirstPage %>
                                <li>
                                    <a href="$PaginatedUniversities.PrevLink" title="View the previous page">«</a>
                                </li>
                            <% else %>	
                                <li class="disabled">
                                    <a>«</a>
                                </li>
                            <% end_if %>

                            <% loop PaginatedUniversities.PaginationSummary(5) %>
                                <% if CurrentBool %>
                                    <li class="active"><a>$PageNum</a></li>
                                <% else %>
                                    <% if Link %>
                                        <li>
                                            <a href="$Link">$PageNum</a>
                                        </li>
                                    <% else %>
                                        <li class="disabled"><a class="disabled">&hellip;</a></li>
                                    <% end_if %>
                                <% end_if %>
                            <% end_loop %>

                            <% if PaginatedUniversities.NotLastPage %>
                                <li>
                                    <a href="$PaginatedUniversities.NextLink" title="View the next page">»</a>
                                </li>
                            <% else %>
                                <li class="disabled">
                                    <a>»</a>
                                </li>
                            <% end_if %>
                        </ul>
                    </div>
                <% end_if %>
            </div>
            <div class="col-sm-3 wow fadeInLeft">
                <h1>Sponsored Content</h1>        
            </div>
        </div>
    </div>
</div>
                
