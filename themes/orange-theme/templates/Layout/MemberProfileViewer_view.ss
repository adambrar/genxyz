<% include Header %>
<div class="main" role="main">
    <div id="main-wrapper">
        <div class="container">
            <div id="content">
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
                                     <% if BlogEntries %>
                                        <% loop BlogEntries %>

                                            <% include StudentBlogSummary TippyTop=$Top %>
                                        <% end_loop %>
                                    <% else %>
                                        <h1><%t BlogHolder_ss.NOENTRIES "There are no blog entries!" %></h1>                                            
                                    <% end_if %>
                                </div>
                                <div class="4u 12u(2)">
                                    <h2><%t StudentProfileView.BLOGARCHIVE "Blog Archive" %></h2>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                <% else %>
                    <div class="row">
                    <div class="6u -3u 12u(1)">
                        <h2><%t StudentProfileView.PROFILENAME "Profile for " %>$Member.FirstName $Member.Surname</h2>
                        <p><%t StudentProfileView.LOGINREMINDER "You need to be logged in to the view this profile!" %></p>
                        <p><%t StudentProfileView.LINKS "<a>Login or Register</a>" %></p>                                                                                         
                    </div>
                    </div>
                <% end_if %>
                </article>
            </div>
        </div>
    </div>
</div>
<% include Footer %>