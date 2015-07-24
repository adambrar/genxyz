<% include Header %>
<div class="main" role="main">
    <div id="main-wrapper">
        <div class="container">
            <div id="content">
                <article>
                    <div class="content">
                        <div class="row">
                            <div class="6u 12u(1)">
                                <% if $isSignedIn %>
                                    <h1><%t ISNetworkPage.YOUARESIGNEDIN "You are currently signed into ISNetwork as " %>$MemberName!</h1>
                                    <ul>
                                        <li><a class="button small icon fa-arrow-circle-right" href="Security/logout"><%t ISNetworkPage.LOGINLINK "Login as someone else" %></a></li>
                                    </ul>

                                <% else %>
                                    <h2><%t ISNetworkPage.LOGIN "Login" %></h2>
                                    $LoginForm
                                <% end_if %>
                            </div>
                            <div class="6u 12u(2)">
                                <video controls>
                                    <source src="{$BaseHref}assets/Uploads/vid.mp4" type="video/mp4">
                                    <source src="{$BaseHref}assets/Uploads/vid.ogv" type="video/ogg">
                                    <source src="{$BaseHref}assets/Uploads/vid.webm" type="video/webm">
                                    <source src="{$BaseHref}assets/Uploads/vid.3gp" type="video/3gp">
                                </video>
                            </div>
                        </div>
                        <div class="row content-box-light">
                            <div class="6u 12u(3) gutters-fix">
                                <div class="small-content-box">
                                    <h2><%t ISNetworkPage.ABOUT "About" %></h2>
                                    $About
                                </div>
                            </div>
                            <div class="6u 12u(4) gutters-fix">
                                <div class="small-content-box">
                                    <h2><%t ISNetworkPage.SERVICES "Services" %></h2>
                                    $Services
                                </div>
                            </div>
                        </div>
                        <div class="row content-box-dark">
                            <div class="6u 12u(5) gutters-fix">
                                <div class="small-content-box">
                                    <h2><%t ISNetworkPage.MEDIA "Media" %></h2>
                                    $Media
                                </div>
                            </div>
                            <div class="6u 12u(6) gutters-fix">
                                <div class="small-content-box">
                                    <h2><%t ISNetworkPage.INTERACTIVE "Interactive" %></h2>
                                    $Interactive
                                </div>
                            </div>
                        </div>
                    </div>

                </article>
            </div>
        </div>
    </div>
</div>
<% include Footer %>