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
                                    <!--Forum content-->
                                    <div class="slider-content">
                                        <h2><i class="fa fa-arrow-circle-right fa-fw"></i><%t StudentProfilePage.Chat "Forum Posts" %></h2>
                                        <div class="not-hidden-content">    
                                            <table class="default mini-forum">
                                                <tr>
                                                    <td><% _t('ForumHolder_ss.FORUM','Forum') %></td>
                                                    <td><% _t('ForumHolder_ss.LASTPOST','Last Post') %></td>
                                                    <td><% _t('ForumHolder_ss.NEWPOST','') %></td>
                                                </tr>
                                                <% loop $AllForums %>
                                                    <% include MiniForumHolder_List %>
                                                <% end_loop %>
                                            </table>
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
        jQuery(".fa-rotate-90").removeClass("fa-rotate-90");
        if(!jQuery(this).parent().find(".hidden-content").is(":visible")) {
            jQuery(this).children().addClass("fa-rotate-90");
        }
        jQuery(".hidden-content").not(jQuery(this).parent().find(".hidden-content")).slideUp(750);
        jQuery(this).parent().find(".hidden-content").slideToggle(750);
    });
</script>                                            
<% include Footer %>