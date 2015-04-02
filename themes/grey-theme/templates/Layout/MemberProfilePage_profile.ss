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
                                <div class="4u 8u(2)">
                                     <% if BlogEntries %>
                                        <% loop BlogEntries %>
                                            <% include StudentBlogSummary %>
                                        <% end_loop %>
                                    <% else %>
                                        <h1><% _t('BlogHolder_ss.NOENTRIES', 'There are no blog entries!') %></h1>                                            
                                    <% end_if %>
                                </div>
                                <div class="4u 4u(2)">
                                    <h2>Blog Management</h2>
                                    <a href="{$BlogPostURL}">Post new blog entry</a>
                                    </br>
                                    <h2>Chat Module</h2>
                                    <iframe src={$chatLink} width="100%" height="480" scrolling="auto" frameborder="0" name="frame_chat"> </iframe>

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