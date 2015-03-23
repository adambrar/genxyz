<% include Header %>
<div id="main-wrapper" class="main" role="main">
    <article>
        <div id="slideshow">
            <div class="container 125%">
                <ul class="slides">
                    <li><img src="{$ThemeDir}/images/slides/1.jpg" alt="Blue World" /></li>
                    <li><img src="{$ThemeDir}/images/slides/2.jpg" alt="Eagle" /></li>
                    <li><img src="{$ThemeDir}/images/slides/3.jpg" alt="Building" /></li>
                    <li><img src="{$ThemeDir}/images/slides/4.jpg" alt="Microprocessor" /></li>
                </ul>

                <span class="arrow previous"></span>
                <span class="arrow next"></span>
            </div>
        </div>

        <div id="banner-wrapper">
            <div id="banner">
                <div id="slideshow-overlay" class="container 80%">
                    <div class="row">
                        <div class="7u text">
                            <h2>International Pathways</h2>
                            <p>It's not just about the money.</p>
                        </div>
                        <div class="5u">
                            <ul>
                                <li><a class="button big icon fa-arrow-circle-right" href="student-profile-page">Students</a></li>
                                <li><a class="button big icon fa-arrow-circle-right" href="[sitetree_link,id=71]">Universities</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row update-box">
                <div class="10u -1u 12u(9)">
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
            <div class="welcome_updates"> 
                <div class="row">
                    <div class="6u 12u(3)">
                        <h2 class="update_title">Recent Blog Posts</h2>
                        <% if StudentBlogPosts %>
                            <% loop $StudentBlogPosts %>
                                <% include StudentBlogSummary %>
                            <% end_loop %>
                        <% else %>
                            <p>There are no recent student posts</p>
                        <% end_if %>
                    </div>
                    <div class="6u 12u(4)">
                        <h2 class="update_title">GenXYZ</h2>
                        <% if GenXYZBlogPosts %>
                            <% loop $GenXYZBlogPosts %>
                                <% include StudentBlogSummary %>
                            <% end_loop %>
                        <% else %>
                            <p>There are no recent posts from GenXYZ</p>
                        <% end_if %>
                    </div>
                </div>
                <div class="row update-box">
                    <div class="6u 12u(7)">
                        <h2 class="update_title">Media Updates</h2>
                        <p>Some random text for testing</p>
                        <p>Some random text for testing</p>
                        <h1 class="update_title">Media Updates</h1>
                        <p>Some random text for testing</p>
                        <p>Some random text for testing</p>
                        <h1 class="update_title">Media Updates</h1>
                        <p>Some random text for testing</p>
                        <p>Some random text for testing</p>
                    </div>
                    <div class="6u 12u(5)">
                        <h2 class="update_title">Interactive Updates</h2>
                        <p>Some random text for testing</p>
                        <p>Some random text for testing</p>
                        <h1 class="update_title">Interactive Updates</h1>
                        <p>Some random text for testing</p>
                        <p>Some random text for testing</p>

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
