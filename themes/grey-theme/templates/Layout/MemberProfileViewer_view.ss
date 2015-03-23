<% include Header %>
<div class="main" role="main">
	<div class="inner typography line">
        <div id="main-wrapper">
            <div class="container">
                <div id="content">
                    <div class="content-container unit size3of4 lastUnit">
                        <article>
                        <% if IsLoggedIn %>
                            <div class="row">
                                <div class="4u 12u(1)">
                                    <% include ViewStudentSidebar %>
                                </div>
                                <div class="8u 12u(2)>
                                <div class="content">
                                    <h2>$Title</h2>

                                    <div class="row">
                                        <div class="8u 12u(1)">
                                             <% if BlogHolder %>
                                             <% with BlogHolder %>
                                                <% loop BlogEntries %>
                                                    <% include StudentBlogSummary %>
                                                <% end_loop %>
                                            <% end_with %>
                                            <% else %>
                                                <h1><% _t('BlogHolder_ss.NOENTRIES', 'There are no blog entries!') %></h1>
                                            <% end_if %>
                                        </div>
                                        <div class="4u 12u(2)">
                                            <h2>Blog Archive</h2>
                                        </div>
                                    </div>
                                </div>
                                </div>
                            </div>
                        <% else %>
                            <div class="row">
                            <div class="6u -3u 12u(1)">
                                <h2>$Member.FirstName {$Member.Surname}'s Profile</h2>
                                <p>You need to be logged in to the view this profile!</p> 
                                <p><a href="Security/login">Login</a> or <a href="register">Register</a> to view profiles.</p>
                            </div>
                            </div>
                        <% end_if %>
                        </article>
                    </div>
                </div>
            </div>
        </div>
	</div>
</div>
<% include Footer %>