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
                                <div class="4u gutters-fix">
                                    <div class="small-content-box">
                                        <% include StudentSidebar %>
                                    </div>
                                </div>
                                <div class="8u gutters-fix">
                                    <div class="small-content-box">
                                        <h2>Academics Page Coming Soon!</h2>
                                    </div>
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
<script type="text/javascript">

tinyMCE.init({
theme : "advanced",
mode: "textareas", 
theme_advanced_toolbar_location : "top",
theme_advanced_buttons1 : "formatselect,|,bold,italic,underline,separator,justifyleft,justifycenter,justifyright,justifyfull,separator,outdent,indent,separator,undo,redo",
theme_advanced_buttons2 : "",
theme_advanced_buttons3 : "",
height:"250px",
width:"400px"
});

</script>

<% include Footer %>