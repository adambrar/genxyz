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
                                    <% include StudentBlogSummary %>
                                <% end_loop %>
                            <% else %>
                                <h1><% _t('BlogHolder_ss.NOENTRIES', 'There are no blog entries!') %></h1>                                            
                            <% end_if %>
                        </div>
                        <div class="4u 4u(2)">
                            <h2><%t StudentProfilePage.BLOGMANAGEMENT "Blog Management" %></h2>
                            <p><a href="{$BlogPostURL}"><%t StudentProfile.NEWBLOGPOST "Post new blog" %></a></p>
                            <p><a href="{$BlogURL}"><%t StudentProfilePage.VIEWBLOG "View all blog posts" %></a></p>
                            </br>
                            <h2><%t StudentProfilePage.STUDENTCHATROOM "Student Chatroom" %></h2>
                            <iframe src={$chatLink} width="100%" height="480" scrolling="auto" frameborder="0" name="frame_chat"> </iframe>

                        </div>
                    </div>
                </article>
            </div>
        </div>
    </div>
</div>
<% include Footer %>