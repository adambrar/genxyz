<% include Header %>
<div class="main" role="main">
    <div id="main-wrapper">
        <div class="container">
            <div id="content">
                <article>
                    <% if Member.isStudent %>
                        <div class="row content-box-light">
                            <div class="4u 12u(1) gutters-fix">
                                <div class="small-content-box">
                                    <% include StudentSidebar %>
                                </div>
                            </div>
                            <div class="4u 8u(2) gutters-fix">
                                <% if BlogEntries %>
                                    <div class="small-content-box">
                                        <% loop BlogEntries %>
                                            <% include StudentBlogSummary TippyTop=$Top %>
                                        <% end_loop %>
                                    </div>
                                <% else %>
                                    <h1><% _t('BlogHolder_ss.NOENTRIES', 'There are no blog entries!') %></h1>                                            
                                <% end_if %>
                            </div>
                            <div class="4u 4u(2) gutters-fix">
                                <% include StudentLeftBar %>

                            </div>
                        </div>
                    <% else %>
                        <div class="row">
                            <div class="6u -3u 12u(1)">
                                <div class="row content-box-light">
                                <h2><%t AccessDenied.TITLE "Access Denied" %></h2>
                                <h1><%t StudentProfileView.LOGINREMINDER "You need to be logged in as a student to view this content!" %></h1>
                                <div class="row">
                                    <div class="6u">
                                        <ul>
                                            <li><a class="button small icon fa-arrow-circle-right" href="register">Register</a></li>
                                        </ul>
                                    </div>
                                    <div class="6u">
                                        <ul>
                                            <li><a class="button small icon fa-arrow-circle-right" href="Security/login">Login</a></li>
                                        </ul>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                    <% end_if %>
                </article>
            </div>
        </div>
    </div>
</div>
<% include Footer %>