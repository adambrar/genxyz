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
                            <div class="8u 12u(2) gutters-fix">    
                                <div class="small-content-box">
                                    <div class="slider-content">
                                        <h2 class="content-slider"><%t StudentProfilePage.STUDENTCHATROOM "Student Chatroom" %></h2>
                                        <iframe id="student-chat" class="hidden-content" src={$ChatLink} width="100%" height="800" scrolling="auto" frameborder="0" name="frame_chat"> </iframe>
                                    </div>
                                    <div class="slider-content">
                                        <h2 class="content-slider"><%t StudentProfilePage.BLOGMANAGEMENT "Blog Management" %></h2>
                                        <div class="row hidden-content" style="display:none">    
                                            <div class="7u">
                                                <% if BlogEntries %>
                                                        <% loop BlogEntries %>
                                                            <% include SingleBlogSummary TippyTop=$Top %>
                                                        <% end_loop %>
                                                <% else %>
                                                    <h1><% _t('BlogHolder_ss.NOENTRIES', 'There are no blog entries!') %></h1>                                            
                                                <% end_if %>
                                            </div>
                                            <div class="5u">
                                                <ul>
                                                    $BlogManagementURLs
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="slider-content">
                                        <h2 class="content-slider"><%t StudentProfilePage.Chat "Forum Posts" %></h2>
                                        <div class="row hidden-content" style="display:none">    
                                            <% if ForumPosts %>
                                                <% loop ForumPosts %>
                                                    <h1><a href="$Link">$Title</a></h1>
                                                    <p class="post-date">$Created.Long at $Created.Time</p>
                                                    <p>$Content.LimitCharacters(80)</p>
                                                <% end_loop %>
                                            <% else %>
                                                <h1><%t StudentProfile.NOPOSTS "There are no recent forum posts!" %></h1>                                            
                                            <% end_if %>
                                        </div>

                                    </div>
                                </div>
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
<script type="text/javascript">
    jQuery(".content-slider").click(function(){
    jQuery(".hidden-content").not(jQuery(this).parent().find(".hidden-content")).slideUp(500);
    jQuery(this).parent().find(".hidden-content").slideToggle(1000);
    
});
</script>                                            
<% include Footer %>