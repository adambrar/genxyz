<% include Header %>
<div class="main" role="main">
    <div id="main-wrapper">
        <div class="container">
            <div id="content">
                <article>
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
                </article>
            </div>
        </div>
    </div>
</div>
<% include Footer %>