<% include Header %>
<div class="main" role="main">
    <div id="main-wrapper">
        <div class="container">
            <div id="content">
                <article>
                    <div class="row">
                        <div class="4u 12u(1)">
                            <% include StudentSidebar %>
                        </div>
                        <div class="4u 8u(2)">
                             <% if BlogEntries %>
                                <% loop BlogEntries %>
                                    <% include StudentBlogSummary TippyTop=$Top %>
                                <% end_loop %>
                            <% else %>
                                <h1><% _t('BlogHolder_ss.NOENTRIES', 'There are no blog entries!') %></h1>                                            
                            <% end_if %>
                        </div>
                        <div class="4u 4u(2)">
                            <% include StudentLeftBar %>

                        </div>
                    </div>
                </article>
            </div>
        </div>
    </div>
</div>
<% include Footer %>