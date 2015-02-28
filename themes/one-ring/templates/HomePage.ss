<% include Head %>
<body class="$ClassName<% if not $Menu(2) %> no-sidebar<% end_if %>" <% if $i18nScriptDirection %>dir="$i18nScriptDirection"<% end_if %>>

<% include Header %>
<div class="main" role="main">
	<div class="inner typography line">
        <div id="main-wrapper">
            <div class="container">
                <div id="content">
                    <div class="content-container unit size3of4 lastUnit">
                        <article>
                            <div class="content">
                                $Content
                            </div>
      
                            <br/>
                            <div class="welcome_updates"> 
                                <div class="row">
                                    <div class="4u 12u(3)">
                                        <h2 class="update_title">Recent Blog Posts</h2>
                                        <% loop $LatestBlogPosts %>
                                            <% include WelcomeBlogSummary %>
                                        <% end_loop %>
                                    </div>
                                    <div class="4u 12u(4)">
                                        <h2 class="update_title">GenXYZ</h2>

                                    </div>
                                    <div class="4u 12u(5)">
                                        <h2 class="update_title">Interactive Updates</h2>
                                    </div>
                                </div>
                                <br/>
                                <div class="row">
                                    <div class="4u 12u(6)">
                                        <h2 class="update_title">Our Initiatives Updates</h2>

                                    </div>
                                    <div class="4u 12u(7)">
                                        <h2 class="update_title">Media Updates</h2>

                                    </div>
                                    <div class="4u 12u(8)">
                                        <h2 class="update_title">Our Partners Updates</h2>

                                    </div>

                                </div>
                                <br/>
                                <div class="row">
                                    <div class="12u 12u(9)">

                                        <h2 class="update_title">Forum Updates</h2>
                                        <table class="welcome_forum">
                                            <tr class="category">
                                                <td><% _t('ForumHolder_ss.FORUM','Forum') %></td>
                                                <td><% _t('ForumHolder_ss.LASTPOST','Last Post') %></td>
                                            </tr>
                                            <% loop $AllForums %>
                                                <% include WelcomeForumHolder_List %>
                                            <% end_loop %>
                                        </table>
                                    </div>

                                </div>
                            </div>
                        </article>
                            $Form
                            $PageComments
                    </div>
                </div>
            </div>
        </div>
	</div>
</div>
<% include Footer %>

<% require javascript('framework/thirdparty/jquery/jquery.js') %>
<%-- Please move: Theme javascript (below) should be moved to mysite/code/page.php  --%>
<script type="text/javascript" src="{$ThemeDir}/javascript/script.js"></script>

</body>
</html>
