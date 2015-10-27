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
                <div class="wow fadeInRight">
                    <% if isSignedIn %>
                    <% if isProfileSaved %>
                        <h4 class="message good">Your profile has been saved</h4>
                    <% end_if %>
                    <ul class="nav nav-pills">
                        <li class="active"><a data-toggle="pill" href="#blogposts">Blog</a></li>
                        <li class=""><a data-toggle="pill" href="#forumposts">Forum Posts</a></li>
                        <% loop Menu(1).Filter('menuStudentSidebar', 1) %>
                            <% if $Children %>
                                <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown">$MenuTitle.XML</a>
                                    <ul class="dropdown-menu">
                                        <% loop Children %>
                                            <li><a data-toggle="pill" href="#$URLSafeTitle()">$MenuTitle.XML</a></li>
                                        <% end_loop %>
                                    </ul>
                                </li>
                            <% else %>
                                <li><a data-toggle="pill" href="#$URLSafeTitle()">$MenuTitle.XML</a></li>
                            <% end_if %>
                        <% end_loop %>
                        <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown">Edit Your Information</a>
                            <ul class="dropdown-menu">
                                <li><a data-toggle="pill" href="#basicform">Basic Information</a></li>
                                <li><a data-toggle="pill" href="#addressform">Address</a></li>
                                <li><a data-toggle="pill" href="#educationform">Education</a></li>
                                <li><a data-toggle="pill" href="#contactform">Emergency Contact</a></li>
                                <li><a data-toggle="pill" href="#profilepicture">Profile Picture</a></li>
                            </ul>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div id="blogposts" class="tab-pane fade in active">
                            <div class="row">
                                <% with Member.getBlogHolder() %>
                                    <div class="btn-group btn-group-justified" role="group">
                                        <a href="$postURL" type="button" class="btn btn-primary btn-md">Write a new post <i class="fa fa-pencil-square"></i></a>
                                        <a href="$Link" type="button" class="btn btn-primary btn-md">See all your posts <i class="fa fa-file-text-o"></i></a>
                                        <a href="$Parent.Link" type="button" class="btn btn-primary btn-md">See all recent posts <i class="fa fa-files-o"></i></a>
                                    </div>
                                    <h3 class="text-center">Your latest posts in <a title="View all your blog posts" href="$Link">$Title</a></h3>
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
                                <h3 class="text-center">Your latest posts in the <a href="forums">Forum</a></h3>
                                <% loop Member.getLatestForumPosts(10) %>
                                    <div class="list-group-item col-sm-6 wow fadeInRight" data-wow-duration="800ms" <% if Odd %>data-wow-delay="100ms"<% else %>data-wow-delay="300ms"<% end_if %>>
                                        <% include SmallSinglePost %>
                                    </div>
                                <% end_loop %>
                            </div>
                        </div>
                        <div id="basicform" class="tab-pane fade">
                            <div class="wow fadeInRight">
                                $getProfileForm("Basic")
                            </div>
                        </div>
                        <div id="addressform" class="tab-pane fade">
                            <div class="row">
                                <div class="col-md-offset-1 wow fadeInRight">
                                    $getProfileForm("Address")
                                </div>
                            </div>
                        </div>
                        <div id="educationform" class="tab-pane fade">
                            <div class="row">
                                <div class="col-md-offset-1 wow fadeInRight">
                                    $getProfileForm("Education")
                                </div>
                            </div>
                        </div>
                        <div id="contactform" class="tab-pane fade">
                            <div class="row">
                                <div class="col-md-offset-1 wow fadeInRight">
                                    $getProfileForm("Contact")
                                </div>
                            </div>
                        </div>
                        <div id="profilepicture" class="tab-pane fade">
                            <div class="row">
                                <div class="col-md-offset-1 wow fadeInRight">
                                    $getProfileForm("ProfilePicture")
                                </div>
                            </div>
                        </div>
                        <% loop Menu(1).Filter('menuStudentSidebar', 1) %>
                            <% if Children %>
                                <% loop Children %> 
                                    <div id="$URLSafeTitle()" class="tab-pane fade">
                                        <% if $ClassName = 'ScholarshipsPage' %>
                                        <% include ScholarshipsPage %> 
                                    <% else_if $ClassName = 'AcademicsPage' %>
                                        <% include AcademicsPage %>
                                    <% else_if $ClassName = 'SidebarMenuPage' %>
                                        <% include SidebarMenuPage %>
                                    <% else %>
                                        <% include DefaultTabContent %>
                                    <% end_if %>
                                    </div>
                                <% end_loop %>
                            <% else %>
                                <div id="$URLSafeTitle()" class="tab-pane fade">
                                    <% if $ClassName = 'ScholarshipsPage' %>
                                        <% include ScholarshipsPage %> 
                                    <% else_if $ClassName = 'AcademicsPage' %>
                                        <% include AcademicsPage %>
                                    <% else_if $ClassName = 'SidebarMenuPage' %>
                                        <% include SidebarMenuPage %>
                                    <% else %>
                                        <% include DefaultTabContent %>
                                    <% end_if %>
                                </div>
                            <% end_if %>
                        <% end_loop %>                        
                    </div>
                    <% else %>
                        <h2>You need to sign in to view the rest of this profile</h2>
                    <% end_if %>
                </div>
            </div>
        </div>
    </div>
</div>