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
                                     <% if $Children %>
                                        <% loop $Children %>
                                            <% include ServiceRequest %>
                                        <% end_loop %>
                                     <% else %>
                                        <p>There are noooo children</p>
                                     <% end_if %>
                                </div>
                                <div class="3u 4u(2)">
                                    <h2>Blog Management</h2>
                                    <a href="{$BlogPostURL}">Post new blog entry</a>
                                    </br>
                                    <h2>Chat Module</h2>
                                    <h1>This is where the chat module will live...</h1>
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