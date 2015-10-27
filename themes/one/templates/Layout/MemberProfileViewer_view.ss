<% include EmptyHeader %>
<div id="content">
    <div class="container margin-bottom margin-top">
        <div class="row">
            <div class="col-md-3">
                <img class="img-responsive img-circle" src="$Member.ProfilePicture.Filename" title="Profile picture" alt="Profile picture not found" />
                <h2 class="text-center wow fadeInLeft"><a>$Member.FirstName $Member.Surname</a></h2>
                <h5 class="text-center wow fadeInLeft" data-wow-delay="200ms">$Member.CurrentCountry.Name</h5>
                <h5 class="text-center wow fadeInLeft" data-wow-delay="400ms">Joined <span class="text-primary">$Member.Created.Ago</span></h5>
            </div>
            <div class="col-md-9 wow fadeInRight">
                <% if isSignedIn %>
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#first">Profile</a></li>
                    <li><a data-toggle="tab" href="#blogposts">Blog</a></li>
                    <li><a data-toggle="tab" href="#forumposts">Forum Posts</a></li>
                </ul>

                <div class="tab-content">
                    <div id="first" class="tab-pane fade in active">
                        <div class="row">
                            <div class="col-md-6 wow fadeInUp">
                                <ul class="list-group">
                                    <li class="list-group-item"><i class="fa fa-graduation-cap"></i> High School <span class="pull-right">$Member.HighSchool.Title</span></li>
                                    <li class="list-group-item"><i class="fa fa-institution"></i> University <span class="pull-right">$Member.University.Title</span></li>
                                    <li class="list-group-item"><i class="fa fa-gift"></i> Birthday <span class="pull-right">$Member.DateOfBirth.Long</span></li>
                                    <li class="list-group-item"><i class="fa fa-map-marker"></i> City <span class="pull-right">$Member.City.Name</span></li>
                                </ul>  
                            </div>
                            <div class="col-md-6 wow fadeInUp" data-wow-delay="300ms">
                                <ul class="list-group">
                                    <li class="list-group-item"><i class="fa fa-file-text-o"></i> Number of Blog Posts <span class="pull-right">$Member.getBlogHolder().HolderEntries.Count()</span></li>
                                    <li class="list-group-item"><i class="fa fa-folder-open-o"></i> Number of Forum Posts <span class="pull-right">$Member.NumPosts</span></li>
                                    <li class="list-group-item list-group-item-success"><i class="fa fa-star"></i> Member Rank <span class="pull-right">Student</span></li>
                                </ul>  
                            </div>
                        </div>
                    </div>
                    <div id="blogposts" class="tab-pane fade">
                        <div class="row">
                            <% with Member.getBlogHolder() %>
                                <h3><a title="View all blog posts" href="$Link">$Title</a></h3>
                                <% loop HolderEntries(15) %>
                                    <div class="col-sm-6 wow fadeInRight" data-wow-duration="800ms" <% if Odd %>data-wow-delay="100ms"<% else %>data-wow-delay="300ms"<% end_if %>>
                                        <% include SmallBlogSummary %>
                                    </div><!--/.col-md-4-->
                                <% end_loop %>
                            <% end_with %>
                        </div>
                    </div>
                    <div id="forumposts" class="tab-pane fade">
                        <div class="list-group">
                            <% loop Member.getLatestForumPosts() %>
                                <div class="list-group-item col-sm-6 wow fadeInRight" data-wow-duration="800ms" <% if Odd %>data-wow-delay="100ms"<% else %>data-wow-delay="300ms"<% end_if %>>
                                    <% include SmallSinglePost %>
                                </div>
                            <% end_loop %>
                        </div>
                    </div>
                </div>
                <% else %>
                    <h2>You need to sign in to view the rest of this profile</h2>
                <% end_if %>
            </div>
        </div>
    </div>
</div>