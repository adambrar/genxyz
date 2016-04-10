<% include EmptyHeader %>
<div id="content">
    <div class="container margin-bottom margin-top">
        <div class="row">
            <div class="col-md-3">
                <img class="img-responsive img-circle" src="$Member.ProfilePicture.Filename" title="Profile picture" alt="Profile picture not found" />
                <h2 class="text-center wow fadeInLeft"><a>$Member.FirstName $Member.Surname</a></h2>
                <h5 class="text-center wow fadeInLeft" data-wow-delay="200ms">$Member.CurrentCountry.Name</h5>
                <h5 class="text-center wow fadeInLeft" data-wow-delay="400ms">Joined <span class="text-primary">$Member.Created.Ago</span></h5>
                <ul class="list-group">
                    <li class="list-group-item"><i class="fa fa-file-text-o"></i> Number of Blog Posts <span class="pull-right">$Member.getBlogHolder().HolderEntries.Count()</span></li>
                    <li class="list-group-item"><i class="fa fa-folder-open-o"></i> Number of Forum Posts <span class="pull-right">$Member.getLatestForumPosts().Count()</span></li>
                    <li class="list-group-item list-group-item-success"><i class="fa fa-star"></i> Member Rank <span class="pull-right">Student</span></li>
                </ul>
                <% include SessionMessage %>
            </div>
            <div class="col-md-9 wow fadeInRight">
            <ul class="nav nav-pills">
                <li class="active"><a data-toggle="pill" href="#profile-forms">Edit Profile</a></li>
                <li class=""><a data-toggle="pill" href="#student-services">Services</a></li>
                <li class=""><a data-toggle="pill" href="#orders">Orders</a></li>
                <li><a data-toggle="pill" href="#messages">Messages</a></li>
                <li class=""><a data-toggle="pill" href="#forumposts">Forum Posts</a></li>
                <% if Member.getBlogHolder() %><li class=""><a data-toggle="pill" href="#blogposts">Blog</a></li><% end_if %>
                <% loop Menu(1).Filter('menuStudentSidebar', 1) %>
                    <% if $Children %>
                        <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown">$MenuTitle.XML</a>
                            <ul class="dropdown-menu">
                                <% loop Children %>
                                    <li><a data-toggle="pill" href="#{$URLSafeTitle()}-content">$MenuTitle.XML</a></li>
                                <% end_loop %>
                            </ul>
                        </li>
                    <% else %>
                        <li><a data-toggle="pill" href="#{$URLSafeTitle()}-content">$MenuTitle.XML</a></li>
                    <% end_if %>
                <% end_loop %>
            </ul>
            <div id="myprofile-tab-content" class="tab-content">
                <div id="messages" class="tab-pane fade">
                    <% if AddMessageForm %>
                        <% include MessageBox %>
                    <% else %>
                        <h3 class="text-center">You currently have no messages to view.</h3>
                    <% end_if %>
                </div>
                <div id="orders" class="tab-pane fade">
                    <div class="row">
                        <ul class="list-group col-sm-6">
                        <li class="list-group-item list-group-item-default"><h2>Active Applications</h2></li>
                        <% if Member.InProcessApplications %>
                            <% loop Member.InProcessApplications %>
                                <li class="list-group-item $StatusClass">
                                    <h5><a href="{$School.viewLink()}">$School.Name</a> - <small>$Created.Ago</small>
                                        <button type="button" class="pull-right" data-toggle="modal" data-target="#editModal" data-application-id="{$ID}"><i class="fa fa-edit"></i></button>
                                    </h5>
                                </li>
                            <% end_loop %>
                        <% else %>
                            <li class="list-group-item"><h5><strong>No active applications</strong></h5></li>
                        <% end_if %>
                    </ul>
                    <ul class="list-group col-sm-6">
                        <li class="list-group-item list-group-item-default"><h2>Done Processing</h2></li>
                        <% if Member.DoneApplications %>
                            <% loop Member.DoneApplications %>
                                <li class="list-group-item $StatusClass">
                                    <h5><a href="{$School.viewLink()}" target="_blank">$School.Name</a> - <small>$Created.Ago</small>
                                        <button type="button" class="pull-right" data-toggle="modal" data-target="#editModal" data-application-id="{$ID}"><i class="fa fa-edit"></i></button>
                                    </h5>
                                </li>
                            <% end_loop %>
                        <% else %>
                            <li class="list-group-item"><h5><strong>No completed applications</strong></h5></li>
                        <% end_if %>
                    </ul>
                    </div>
                </div>
                <% if Member.getBlogHolder() %>
                <div id="blogposts" class="tab-pane fade">
                    <div class="row">
                        <% with Member.getBlogHolder() %>
                            <div class="btn-group btn-group-justified" role="group">
                                <a href="$postURL" type="button" class="btn btn-primary btn-md">Write a new post <i class="fa fa-pencil-square"></i></a>
                                <a href="$Link" type="button" class="btn btn-primary btn-md">See all your posts <i class="fa fa-file-text-o"></i></a>
                                <a href="$Parent.Link" type="button" class="btn btn-primary btn-md">See all recent posts <i class="fa fa-files-o"></i></a>
                            </div>
                            <h3 class="text-center">Your latest posts in <a title="View all your blog posts" href="$Link">$Title</a></h3>
                            <% loop HolderEntries(15) %>
                                <div class="wow fadeInRight" data-wow-duration="800ms" <% if Odd %>data-wow-delay="100ms"<% else %>data-wow-delay="300ms"<% end_if %>>
                                    <% include SmallBlogSummary %>
                                </div><!--/.col-md-4-->
                            <% end_loop %>
                        <% end_with %>
                    </div>
                </div>
                <% end_if %>
                <div id="forumposts" class="tab-pane fade">
                    <div class="row">
                        <div class="list-group">
                            <h3 class="text-center">Latest posts in the <a href="forums">Forum</a></h3>
                            <div class="col-md-6">
                                <h4>Your Posts</h4>
                                <% loop Member.getLatestForumPosts(10) %>
                                    <div class="list-group-item wow fadeInRight" data-wow-duration="800ms" data-wow-delay="<% if Odd %>5<% else %>3<% end_if %>00ms">
                                        <% include SmallSinglePost %>
                                    </div>
                                <% end_loop %>
                            </div>
                            <h4>Forum Posts</h4>
                            <div class="col-md-6">
                                <% loop ForumPosts %>
                                    <div class="list-group-item wow fadeInRight" data-wow-duration="800ms" <% if Odd %>data-wow-delay="100ms"<% else %>data-wow-delay="300ms"<% end_if %>>
                                        <% include SmallSinglePost %>
                                    </div>
                                <% end_loop %>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="student-services" class="tab-pane fade">
                    <% include SearchMembers %>
                </div>
                <div id="profile-forms" class="tab-pane fade in active">
                    <div class="row">
                        <div class="col-xs-4">
                            <div id="profile-form-call" class="list-group">
                                <a href="#Picture" data-form-name="ProfilePicture" class="list-group-item active">Profile Picture</a>
                                <a href="#Basic" data-form-name="Basic" class="list-group-item">Basic Information</a>
                                <a href="#Address" data-form-name="Address" class="list-group-item">Address</a>
                                <a href="#Education" data-form-name="Education" class="list-group-item">Education</a>
                                <a href="#Contact" data-form-name="Contact" class="list-group-item">Emergency Contact</a>
                            </div>
                        </div>
                        <div id="profile-forms-content" class="col-xs-8">
                            $getProfileForm("ProfilePicture")
                        </div>
                    </div>
                </div>
                <% loop Menu(1).Filter('menuStudentSidebar', 1) %>
                    <% if Children %>
                        <% loop Children %> 
                            <div id="{$URLSafeTitle()}-content" class="tab-pane fade">
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
                        <div id="{$URLSafeTitle()}-content" class="tab-pane fade">
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
            </div>
        </div>
        <div class="wow fadeInRight">
            
        </div>
    </div>
</div>
<div class="modal" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Application Details</h4>
      </div>
      <div class="modal-body">
        <h2 class="text-center"><i class="fa fa-2x fa-spinner fa-spin"></i></h2>
      </div>
      <div class="modal-footer">
        
      </div>
    </div>
  </div>
</div>
