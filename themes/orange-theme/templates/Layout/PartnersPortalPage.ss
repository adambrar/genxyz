<% include Header %>
<div class="main" role="main">
    <div id="main-wrapper">
        <div class="container">
            <div id="content">
                <article>
                    <div class="content content-box-light">
                        <div class="row">
                            <div class="8u -2u 12u(1) gutters-fix">
                                <div class="small-content-box">
                                    <h2>$Title</h2>
                                    <p>$Message</p>
                                </div>  
                            </div>  
                        </div>
                        <div class="row">
                            <div class="5u -1u 12u(2) gutters-fix">
                                <div class="small-content-box">
                                    <h2><%t PartnersPortalPage.LOGIN "Login" %></h2>
                                    $LoginForm
                                </div>
                            </div>
                            <div class="5u 12u(3) gutters-fix">
                                <div class="small-content-box">
                                    <h2><%t PartnersPortalPage.REGISTER "Register" %></h2>
                                    $RegisterForm
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