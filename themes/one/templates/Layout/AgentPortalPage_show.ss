<% include EmptyHeader %>
<div id="content">
    <div class="container margin-top margin-bottom">
        <div class="row">
            <div class="col-sm-3 text-center">
                <img class="img-responsive img-circle" src="$Member.Logo.Filename" title="$Name" alt="Profile picture not found" />
                <h2 class="wow fadeInLeft"><a>$Member.FirstName $Member.Surname</a></h2>
                <h5 class="wow fadeInLeft" data-wow-delay="400ms">$Member.AboutMe</h5>
                <ul class="list-group text-left">
                    <li class="list-group-item"><i class="fa fa-graduation-cap"></i> Country <span class="pull-right">$Member.Country.Name</span></li>
                    <li class="list-group-item"><i class="fa fa-map-marker"></i> City <span class="pull-right">$Member.City.Name</span></li>
                    <li class="list-group-item"><i class="fa fa-gift"></i>  Joined<span class="pull-right">$Member.Created.Ago</span></li>
                </ul>
            </div>
            <div class="col-sm-9">
                <% include SessionMessage %>
                <ul class="nav nav-tabs margin-top">
                    <li class="active"><a data-toggle="tab" href="#first">Services</a></li>
                    <li><a data-toggle="tab" href="#contact">Contact</a></li>
                    <li><a data-toggle="tab" href="#blog">Blog</a></li>
                    <li><a data-toggle="tab" href="#partners">Partners</a></li>
                </ul>
                <div class="tab-content margin-bottom">
                    <div id="first" class="tab-pane fade in active">
                        <h3 class="text-center">Services Provided</h3>
                        <div class="row match-height-boxes">
                            <% loop Member.Services() %>
                                <div class="col-sm-6 wow fadeInUp" data-wow-duration="<% if Pos < 5 %>{$Pos}<% else %>4<% end_if %>00ms" data-wow-delay="100ms">
                                    <div class="media service-box match-height-box">
                                        <div class="pull-left">
                                            <i class="fa fa-cube"></i>
                                        </div>
                                        <div class="media-body">
                                            <h4 class="media-heading">$ServiceName.Name</h4>
                                            <p>$Description - ${$Cost}</p>
                                        </div>
                                        <div class="media-footer">
                                            <h4 class="media-heading"><a href="application" class="btn btn-primary">Apply for this service!</a></h4>
                                        </div>
                                    </div>
                                </div>
                            <% end_loop %>
                        </div> 
                    </div>
                    <div id="contact" class="tab-pane fade">
                        <h3 class="text-center">Contact Me</h3>
                        <table class="table contactme">
                            <tbody>
                                <tr>
                                    <td>Phone Number:</td>
                                    <td>$Member.PhoneNumber</td>
                                </tr>
                                <tr>
                                    <td>Email:</td>
                                    <td><a href="mailto:{$Member.Email}">$Member.Email</a></td>
                                </tr>
                                <tr>
                                    <td>Website:</td>
                                    <td><a href="http://$Member.Website">$Member.Website</a></td>
                                </tr>
                                <tr>
                                    <td>Location:</td>
                                    <td>
                                        <ul class="list-unstyled">
                                            <li>$Member.AddressLine1</li>
                                            <li>$Member.AddressLine2</li>
                                            <li>$Member.City</li>
                                            <li>$Member.Country.Name</li>
                                            <li>$Member.PostalCode</li>
                                        </ul>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div><!-- end contact tab -->
                    <div id="blog" class="tab-pane fade">
                        <% with Member.getBlogHolder() %>
                            <% loop HolderEntries(15) %>
                                <div class="wow fadeInRight" data-wow-duration="800ms" <% if Odd %>data-wow-delay="100ms"<% else %>data-wow-delay="300ms"<% end_if %>>
                                    <% include SmallBlogSummary %>
                                </div><!--/.col-md-4-->
                            <% end_loop %>
                        <% end_with %>
                    </div>
                    <div id="partners" class="tab-pane fade">
                        <% if Member.Schools() %>
                            <div class="row">
                                <% loop Member.Schools() %>
                                    <div class="col-md-4 col-sm-6 wow fadeInUp" data-wow-duration="300ms" data-wow-delay="100ms">
                                        <div class="media service-box">
                                            <div class="row">
                                                <div class="col-xs-1"><% if Logo %><img class="img-responsive img-thumbnail partner-logo" src="{$BaseHref}{$Logo.Filename}" alt="Logo" /><% end_if %></div>
                                                <div class="col-xs-10"><a href="$viewLink()"><h3>$Name</h3></a></div>
                                            </div>
                                        </div>
                                    </div><!--/.col-md-4-->
                                <% end_loop %>
                            </div>
                        <% else %>
                            <h4 class="text-center">This school is currently not partnered with any other institutions.</h4>
                        <% end_if %>        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>