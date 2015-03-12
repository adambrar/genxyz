<% include Header %>
<div class="main" role="main">
	<div class="inner typography line">
        <div id="main-wrapper">
            <div class="container">
                <div id="content">
                    <div class="content-container unit size3of4 lastUnit">
                        <article>
                            <div class="row">
                                <div class="4u 12u(1)">
                                    <% include StudentSidebar %>
                                </div>
                                <div class="5u 8u(2)">
                                    <% if BlogEntries %>
                                        <% loop BlogEntries %>
                                            <% include BlogSummary %>
                                        <% end_loop %>
                                    <% else %>
                                        <h2><% _t('BlogHolder_ss.NOENTRIES', 'There are no blog entries') %></h2>
                                    <% end_if %>
                                </div>
                                <div class="3u 4u(2)">
                                    <h2>Blog Management</h2>
                                    <p><a>Post new</a></p>
                                    <h2>Chat Module</h2>
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