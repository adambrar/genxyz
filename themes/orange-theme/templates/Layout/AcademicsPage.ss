<% include Header %>
<div class="main" role="main">
    <div id="main-wrapper">
        <div class="container">
            <div id="content">
                <div class="content-container unit size3of4 lastUnit">
                    <article>
                    <% if isSignedIn %>
                        <div class="content">
                            <div class="row content-box-light">
                                <div class="3u 12u(3) gutters-fix">
                                    <div class="small-content-box">
                                        <h2>Recent Additions</h2>
                                        <h1>Popular Agent 1</h1>
                                        <p>quick description</p>
                                        <h1>Popular Uni</h1>
                                        <p>descriptive words</p>
                                        <h1>Important Scholarship</h1>
                                        <p>description of scholarship</p>
                                    </div>
                                </div>
                                <div class="6u 12u(1) gutters-fix">
                                    <div class="small-content-box">
                                        <p>Select the type of education you are looking for.</p>
                                        $FilterUniversities
                                    </div>
                                </div>
                                <div class="3u 12u(2) gutters-fix">
                                    <div class="small-content-box">
                                        <h2>Updates</h2>
                                        <h1>News 1</h1>
                                        <p>Some details</p>
                                        <h1>News 2</h1>
                                        <p>More exciting news</p>
                                    </div>
                                </div>
                        </div>
                    <% else %>
                        <div class="row">
                            <div class="6u -3u 12u(1)">
                                <div class="row content-box-light">
                                    <h2><%t AccessDenied.TITLE "Access Denied" %></h2>
                                    <h1><%t StudentProfileView.LOGINREMINDER "You need to be logged in to view this content!" %></h1>
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
                    <% end_if %>
                </article>
                </div>
            </div>
        </div>
    </div>
</div>
            
<script src="{$ThemeDir}/javascript/tabbed.js"></script>
<script src="{$ThemeDir}/javascript/academicfilter.js"></script>    

<% include Footer %>