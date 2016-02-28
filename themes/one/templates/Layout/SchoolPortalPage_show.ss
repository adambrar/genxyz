<% include EmptyHeader %>
<div id="content">
    <div class="container margin-bottom">
        <div class="row" style="background-image: radial-gradient(circle at top left, #dfdfdf, #13E5A3 150%);background-image: radial-gradient(circle at top left, #ffffff, #{$ProfilePage.ProfileColour} 150%);">
            <div class="col-md-3 margin-top">
                <img class="img-responsive img-thumbnail img-rounded" src="$Member.Logo.Filename" title="Profile picture" alt="Profile picture not found" />
                <ul class="list-group">
                    <li class="list-group-item text-center wow fadeInLeft">
                        <h4><a>$Member.Name</a></h4>
                        <input type="hidden" class="rating" value="{$Member.GetRating()}" data-filled="glyphicon glyphicon-star fa-2x" data-empty="glyphicon glyphicon-star-empty fa-2x" data-fractions="2" data-readonly /> <br/>
                    </li>
                    <li class="list-group-item"><i class="fa fa-graduation-cap"></i> Country <span class="pull-right">$Member.Country.Name</span></li>
                    <li class="list-group-item"><i class="fa fa-map-marker"></i> City <span class="pull-right">$Member.City</span></li>
                    <li class="list-group-item"><i class="fa fa-institution"></i> Type <span class="pull-right">$Member.Type</span></li>
                    <li class="list-group-item"><i class="fa fa-gift"></i>  Joined<span class="pull-right">$Member.Created.Ago</span></li>
                </ul>  
            </div>
            <div class="col-md-9 wow fadeInRight margin-top">
                <% include SessionMessage %>
                <ul class="nav nav-tabs margin-top">
                    <li class="{$ActiveTabToggle(first,default)}"><a data-toggle="tab" href="#first">Home</a></li>
                    <li class="{$ActiveTabToggle(programs)}"><a data-toggle="tab" href="#programs">Academic Programs</a></li>
                    <li class="{$ActiveTabToggle(application)}"><a data-toggle="tab" href="#application">Application</a></li>
                    <li class="{$ActiveTabToggle(partners)}"><a data-toggle="tab" href="#partners">Partners</a></li>
                    <li class="{$ActiveTabToggle(contact)}"><a data-toggle="tab" href="#contact">Contact</a></li>
                    <li class="{$ActiveTabToggle(links)}"><a data-toggle="tab" href="#links">Application Process</a></li>
                </ul>

                <div class="tab-content margin-bottom">
                    <div id="first" class="tab-pane fade {$ActiveTabContent(first,default)}">
                        <div class="row">
                            <div class="col-sm-5">
                                <div class="wow fadeInLeft">$ProfilePage.AboutSchool</div>
                            </div>
                            <div class="col-sm-7" style="height:400px;">
                                <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                      <li data-target="#myCarousel" data-slide-to="1"></li>
                                      <li data-target="#myCarousel" data-slide-to="2"></li>
                                    </ol>

                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox" style="max-height:400px;">
                                      <div class="item active">
                                        <img src="$ProfilePage.SlideOne.Filename()" alt="Chania">
                                      </div>

                                      <div class="item">
                                        <img src="$ProfilePage.SlideTwo.Filename()" alt="Chania">
                                     </div>

                                      <div class="item">
                                        <img src="$ProfilePage.SlideThree.Filename()" alt="Flower">
                                     </div>
                                    </div>

                                    <!-- Left and right controls -->
                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                                      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                      <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                                      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                      <span class="sr-only">Next</span>
                                    </a>
                                  </div>
                            </div>
                        </div>
                        <% include ReviewSlider %>
                    </div>
                    <div id="programs" class="tab-pane fade {$ActiveTabContent(programs)}">
                        <h3 class="text-center">Programs available at this school</h3>
                        <div class="row">
                            <div class="col-sm-6">
                                <p>Select a program to see a description and links to this schools detailed information about the selected program.</p>
                                <select name="ProgramSelect" class="dropdown" id="ProgramSelect">
                                    <option value>Select a program</option>
                                    <% loop Member.Programs() %>
                                        <option value="{$ID}">$ProgramName.Name</option>
                                    <% end_loop %>
                                </select>
                            </div>
                            <div id="program-details" class="col-sm-6">
                                <% include ProgramDetails %>
                            </div>
                        </div>
                    </div>
                    <div id="partners" class="tab-pane fade {$ActiveTabContent(partners)}">
                        <% if Member.Schools() %>
                            <div class="row">
                                <% loop Member.Schools() %>
                                    <div class="col-md-4 col-sm-6 wow fadeInUp" data-wow-duration="300ms" data-wow-delay="100ms">
                                        <div class="media service-box">
                                            <div class="row">
                                                <div class="col-xs-1"><% if Logo %><img class="img-responsive img-thumbnail partner-logo" src="{$BaseHref}{$Logo.Filename}" alt="Logo" /><% end_if %></div>
                                                <div class="col-xs-10"><h3>$Name</h3></div>
                                            </div>
                                        </div>
                                    </div><!--/.col-md-4-->
                                <% end_loop %>
                            </div>
                        <% else %>
                            <h4 class="text-center">This school is currently not partnered with any other institutions.</h4>
                        <% end_if %>
                    </div>
                    <div id="application" class="tab-pane fade {$ActiveTabContent(application)}">
                        <div class="row">
                            <div class="col-sm-6">
                                $ApplicationForm                   
                            </div>
                            <div class="col-sm-6">
                                <ul class="list-unstyled text-center">
                                    <li><h4>Application Documents required</h4></li>
                                    <li><i class="fa fa-check"></i> Passport</li>
                                    <li><i class="fa fa-check"></i> CV</li>
                                    <li><i class="fa fa-check"></i> Essay</li>
                                    <li><i class="fa fa-check"></i> IELTS/TOEFL Score</li>
                                    <li><i class="fa fa-check"></i> GRE/GMAT Score</li>
                                    <li><i class="fa fa-check"></i> Statement of Purpose</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div id="contact" class="tab-pane fade {$ActiveTabContent(contact)}">
                        <div class="wow fadeInUp">
                            $ProfilePage.ContactInfo
                        </div>
                    </div>
                    <div id="links" class="tab-pane fade {$ActiveTabContent(links)}">
                        <div class="row">
                            <div class=" col-sm-6 col-sm-offset-3 list-group">
                                <a class="text-center list-group-item list-group-item-info wow fadeInUp" data-wow-delay="0ms" href="http://$ProfilePage.Fees" target="_blank"><i class="fa fa-usd" aria-hidden="true"></i> FEES</a>
                                <a class="text-center list-group-item list-group-item-info wow fadeInUp" data-wow-delay="100ms" href="http://$ProfilePage.Application" target="_blank"><i class="fa fa-envelope-o" aria-hidden="true"></i> APPLICATION</a>
                                <a class="text-center list-group-item list-group-item-info wow fadeInUp" data-wow-delay="200ms" href="http://$ProfilePage.ProcessingTime" target="_blank"><i class="fa fa-clock-o" aria-hidden="true"></i> PROCESSING TIME</a>
                                <a class="text-center list-group-item list-group-item-info wow fadeInUp" data-wow-delay="300ms" href="http://$ProfilePage.EnglishRequirements" target="_blank"><i class="fa fa-book" aria-hidden="true"></i> ENGLISH REQUIREMENTS</a>
                                <a class="text-center list-group-item list-group-item-info wow fadeInUp" data-wow-delay="400ms" href="http://$ProfilePage.AdmissionRequirements" target="_blank"><i class="fa fa-edit" aria-hidden="true"></i> ADMISSION REQUIREMENTS</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>