<% include EmptyHeader %>
<div id="content">
    <div class="container margin-bottom">
        <div class="row">
            <div class="col-sm-3 text-center">
                <div class="wow fadeInLeft margin-bottom">
                        <% if Member.Logo %><img class="img-responsive img-thumbnail partner-logo" src="{$BaseHref}{$Member.Logo.Filename()}" alt="Logo" /><% end_if %>
                        <h2 class="text-center">$Member.Name</h2>
                        <a class="btn btn-warning btn-lg" target="_blank" href="{$PreviewPorfileLink}">Preview your profile!</a>
                </div>
            </div>
            <div class="col-sm-9 margin-top">
                <% include SessionMessage %>
                <ul class="nav nav-tabs margin-top">
                    <li class="active"><a data-toggle="tab" href="#basic">Profile Page</a></li>
                    <li><a data-toggle="tab" href="#blogposts">Blog</a></li>
                    <li><a data-toggle="tab" href="#service">Services</a></li>
                    <li><a data-toggle="tab" href="#applications">Orders</a></li>
                    <li><a data-toggle="tab" href="#partners">Partners</a></li>
                    <li><a data-toggle="tab" href="#messages">Messages</a></li>
                </ul>

                <div class="tab-content">
                    <div id="basic" class="tab-pane fade in active">
                        $BasicInfo
                    </div>
                    <div id="blogposts" class="tab-pane fade">
                        <% with $Member.getBlogHolder %>
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
                    <div id="service" class="tab-pane fade">
                        <div class="row">
                            <% if Member.Services() %>
                                <div class="col-sm-6">
                                    $AddServices
                                </div>
                                <div class="col-sm-6">
                                    $EditServices
                                </div>
                            <% else %>
                                <div class="col-sm-6 col-sm-offset-3">
                                    $AddServices
                                </div>
                            <% end_if %>
                        </div>
                    </div>
                    <div id="partners" class="tab-pane fade">
                        $SchoolPartnersForm
                    </div>
                    <div id="messages" class="tab-pane fade">
                        <% include MessageBox %>
                    </div>
                    <div id="applications" class="tab-pane fade">
                        <div class="row">
                            <ul class="list-group col-sm-6">
                                <li class="list-group-item list-group-item-default"><h2>Active Applications</h2></li>
                                <% if Member.InProcessApplications %>
                                    <% loop Member.InProcessApplications %>
                                        <li class="list-group-item $StatusClass">
                                            <h5>{$Student.Name}'s application for {$School.Name}
                                                <button type="button" class="pull-right" data-toggle="modal" data-target="#filesModal" data-application-id="{$ID}"><i class="fa fa-files-o"></i></button>
                                                <button type="button" class="pull-right" data-toggle="modal" data-target="#editModal" data-application-id="{$ID}"><i class="fa fa-edit"></i></button>
                                            </h5>
                                        </li>
                                    <% end_loop %>
                                <% else %>
                                    <li class="list-group-item"><h2><small>No active applications</small></h2></li>
                                <% end_if %>
                            </ul>
                            <ul class="list-group col-sm-6">
                                <li class="list-group-item list-group-item-default"><h2>Done Processing</h2></li>
                                <% if Member.DoneApplications %>
                                    <% loop Member.DoneApplications %>
                                        <li class="list-group-item $StatusClass">
                                            <h5>{$Student.Name}'s application for {$School.Name}
                                                <button type="button" class="pull-right" data-toggle="modal" data-target="#filesModal" data-application-id="{$ID}"><i class="fa fa-files-o"></i></button>
                                                <button type="button" class="pull-right" data-toggle="modal" data-target="#editModal" data-application-id="{$ID}"><i class="fa fa-edit"></i></button>
                                            </h5>
                                        </li>
                                    <% end_loop %>
                                <% else %>
                                    <li class="list-group-item"><h2><small>No completed applications</small></h2></li>
                                <% end_if %>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- end container -->
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
<div class="modal" id="filesModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>