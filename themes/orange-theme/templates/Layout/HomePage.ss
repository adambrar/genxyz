<% include Header %>
<div id="main-wrapper" class="main" role="main">
    <article class="home_page">
        <div id="slideshow">
            <div class="container 125%">
                <ul class="slides">
                    <li><img src="assets/homepage/slides/1.jpg" alt="Blue World" /></li>
                    <li><img src="assets/homepage/slides/2.jpg" alt="Eagle" /></li>
                    <li><img src="assets/homepage/slides/3.jpg" alt="Building" /></li>
                    <li><img src="assets/homepage/slides/4.jpg" alt="Microprocessor" /></li>
                </ul>

                <span class="arrow previous"></span>
                <span class="arrow next"></span>
            </div>
        </div>

        <div id="banner-wrapper">
            <div id="banner">
                <div id="slideshow-overlay" class="container 80%">
                    <div class="row">
                        <div class="3u">
                            <a href="$ThemeDir/images/GenXYZ_dc.jpg" class="image fit"><img src="$ThemeDir/images/GenXYZ_dc.jpg" alt="ProfilePicture" /></a>
                        </div>
                        <div class="9u">
                            <div class="text">
                                <h2>$WelcomeTitle</h2>
                                <p>$WelcomeMessage</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="4u">
                            <ul>
                                <li><a class="button big icon fa-arrow-circle-right" href="isnetwork">Students</a></li>
                            </ul>
                        </div>
                        <div class="4u">
                            <ul>
                                <li><a class="button big icon fa-arrow-circle-right" href="partners-portal">Partners</a></li>
                            </ul>
                        </div>
                        <div class="4u">
                            <ul>
                                <li><a id="see-more-button" class="button big icon fa-arrow-circle-right" href="#">See More</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row welcome_updates content-box-dark" id="forum_updates">
                <div class="10u -1u 12u(9) gutters-fix">
                    <div class="small-content-box">
                        <h2 class="update_title"><%t HomePage.FORUM "Forum Updates" %></h2>
                        <table class="forum-topics welcome_forum">
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
            <div class="welcome_updates"> 
                <div class="row content-box-light">
                    <div class="6u 12u(3) gutters-fix">
                        <div class="small-content-box">
                            <h2 class="update_title"><%t HomePage.STUDENTBLOG "Recent Blog Posts" %></h2>
                            <% if StudentBlogPosts %>
                                <% loop $StudentBlogPosts %>
                                    <% include StudentBlogSummary %>
                                <% end_loop %>
                            <% else %>
                                <p><%t HomePage.NOSTUDENTPOSTS "There are no recent student posts" %></p>
                            <% end_if %>
                        </div>
                    </div>
                    <div class="6u 12u(4) gutters-fix">
                        <div class="small-content-box">
                            <h2 class="update_title"><%t HomePage.GENXYZ "GenXYZ<" %>/h2>
                            <% if GenXYZBlogPosts %>
                                <% loop $GenXYZBlogPosts %>
                                    <% include GenXYZBlogSummary %>
                                <% end_loop %>
                            <% else %>
                                <p><%t HomePage.NOGENXYZPOSTS "There are no recent posts from GenXYZ" %></p>
                            <% end_if %>
                        </div>
                    </div>
                </div>
                <div class="row content-box-dark">
                    <div class="6u 12u(7) gutters-fix">
                        <div class="small-content-box">
                            <h2 class="update_title"><%t HomePage.MEDIA "Media Updates" %></h2>
                            <p>Some random text for testing</p>
                            <p>Some random text for testing</p>
                            <h1 class="update_title">Media Updates</h1>
                            <p>Some random text for testing</p>
                            <p>Some random text for testing</p>
                            <h1 class="update_title">Media Updates</h1>
                            <p>Some random text for testing</p>
                            <p>Some random text for testing</p>
                        </div>
                    </div>
                    <div class="6u 12u(5) gutters-fix">
                        <div class="small-content-box">
                            <h2 class="update_title"><%t HomePage.INTERACTIVE "Interactive Updates" %></h2>
                            <p>Some random text for testing</p>
                            <p>Some random text for testing</p>
                            <h1 class="update_title">Interactive Updates</h1>
                            <p>Some random text for testing</p>
                            <p>Some random text for testing</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </article>
    $Form
    $PageComments
</div>
<script src="{$ThemeDir}/javascript/slideshow.js"></script>
<script src="{$ThemeDir}/javascript/autoload.js"></script>

<% include Footer %>
