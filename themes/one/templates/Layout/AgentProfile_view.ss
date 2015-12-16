<% include EmptyHeader %>
<div id="content">
    <div class="container margin-top margin-bottom">
        <% include SessionMessage %></%>
        <div class="row">
            <div class="col-sm-3">
                <img class="img-responsive img-circle" src="$Member.Logo.Filename" title="$Name" alt="Profile picture not found" />
        <h2 class="text-center wow fadeInLeft"><a>$Member.FirstName $Member.Surname</a></h2>
        <h5 class="text-center wow fadeInLeft" data-wow-delay="400ms">$Member.AboutMe</h5>
            </div>
            <div class="col-sm-6">
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
            <div class="col-sm-3">
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
            </div>
        </div>
    </div>
</div>