<% include Header %>
<div class="main" role="main">
	<div class="inner typography line">
        <div id="main-wrapper">
            <div class="container">
                <div id="content">
                    <div class="content-container unit size3of4 lastUnit">
                        <article>
                            <div class="content row">
                            <div class="6u -3u 12u(1)">
                                <h2>$Title</h2>

                                <% if $Success %>
                                    <p>You have successfully registered.</p>
                                    <p>Here is your information</p>
                                    <% with CurrentMember %>
                                        <p>
                                            Name: $Name<br />
                                            Email: $Email<br />
                                            Website: <% if Website %>$Website<% else %>Unspecified<% end_if %><br />
                                            Job Title: <% if JobTitle %>$JobTitle<% else %>Unspecified<% end_if %><br />
                                            Blurb: <% if Blurb %>$Blurb<% else %>Unspecified<% end_if %>
                                        </p>
                                    <% end_with %> 
                                    <a href="$Link">Edit details</a>
                                <% else %>     
                                    
                                    <% if $Saved %>
                                        <p>Your profile details have been saved!</p>
                                    <% end_if %>
                                    
                                    $EditProfileForm
                                <% end_if %>   
                            </div>
                            </div>
                        </article>
                    </div>
                </div>
            </div>
        </div>
	</div>
</div>
<% include Footer %>