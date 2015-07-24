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
                                <div class="3u 12u(1) gutters-fix">
                                    <div class="small-content-box">
                                        $FilterAcademics
                                    </div>
                                </div>
                                <div class="6u 12u(2) gutters-fix">
                                    <div class="small-content-box">
                                        <h2>Universities</h2>
                                        <% loop PaginatedUniversities %>
                                            <div class="row">
                                                <div class="3u">
                                                    <a href="$Top.showProfilePageLink($ID)" class="image fit"><img class="avatar" src="$Top.LogoLink($ID)" alt="Logo" /></a>
                                                </div>
                                                <div class="9u">
                                                    <h1><a href="$Top.showProfilePageLink($ID)" >$BusinessName</a></h1>
                                                    <p>$Top.CountryName($BusinessCountryID) - $BusinessTelephone</p>
                                                </div>
                                            </div>
                                        <% end_loop %>
                                        <% if $PaginatedUniversities.MoreThanOnePage %>
                                            <% if $PaginatedUniversities.NotFirstPage %>
                                                <a class="prev button small" href="$PaginatedUniversities.PrevLink">Prev</a>
                                            <% end_if %>
                                            <% loop $PaginatedUniversities.Pages %>
                                                <% if $CurrentBool %>
                                                    $PageNum
                                                <% else %>
                                                    <% if $Link %>
                                                        <a href="$Link">$PageNum</a>
                                                    <% else %>
                                                        ...
                                                    <% end_if %>
                                                <% end_if %>
                                                <% end_loop %>
                                            <% if $PaginatedUniversities.NotLastPage %>
                                                <a class="next button small" href="$PaginatedUniversities.NextLink">Next</a>
                                            <% end_if %>
                                        <% end_if %>
                                    </div>
                                </div>
                                <div class="3u 12u(3) gutters-fix">
                                    <div class="small-content-box">
                                        <h2>Updates</h2>
                                        $Updates
                                    </div>
                                    <div class="small-content-box">
                                        <h2>Recently Added</h2>
                                        $RecentlyAdded
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