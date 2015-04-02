<% include Header %>
<div class="main" role="main">
	<div class="inner typography line">
        <div id="main-wrapper">
            <div class="container">
                <div id="content">
                    <div class="content-container unit size3of4 lastUnit">
                        <article>
                            <div class="content">
                                <div class="row">
                                    <div class="6u 12u(1)">
                                        <% if $isSignedIn %>
                                            <h2>You are currently signed into ISNetwork as $MemberName!</h2>
                                            <ul>
                                                <li><a class="button small icon fa-arrow-circle-right" href="Security/logout">Login as someone else</a></li>
                                            </ul>
    
                                        <% else %>
                                            <h2>Login</h2>
                                            $LoginForm
                                            <a href="register">Create new account</a>
                                        <% end_if %>
                                    </div>
                                    <div class="6u 12u(2)">
                                        <video controls>
                                            <source src="/silverstripe/assets/Uploads/vid.mp4" type="video/mp4">
                                            <source src="/silverstripe/assets/Uploads/vid.ogv" type="video/ogg">
                                            <source src="/silverstripe/assets/Uploads/vid.webm" type="video/webm">
                                            <source src="/silverstripe/assets/Uploads/vid.3gp" type="video/3gp">
                                        </video>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="6u 12u(3)">
                                        <h2>About</h2>
                                        $About
                                    </div>
                                    <div class="6u 12u(4)">
                                        <h2>Services</h2>
                                        $Services
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="6u 12u(5)">
                                        <h2>Media</h2>
                                        $Media
                                    </div>
                                    <div class="6u 12u(6)">
                                        <h2>Interactive</h2>
                                        $Interactive
                                    </div>
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