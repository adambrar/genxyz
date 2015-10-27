<header id="header">
    <nav id="main-menu" class="navbar navbar-default navbar-fixed-top" role="banner">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href=""><h2 style="font-family:'Lucida Console', Monaco, monospace;color:white;">GenXYZ</h2></a>
            </div>
            
            <div class="collapse navbar-collapse navbar-right">
                <ul class="nav navbar-nav">
                    <% if isSignedIn %>
                        <li><a href="$profilePageLink">My Profile</a></li>
                    <% end_if %>
                    <li><a href="home">Go Home</a></li>
                    <% if isSignedIn %>
                        <li><a href="$BaseHref/Security/logout">Logout</a></li>
                    <% else %>
                        <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown">Login</a>
                            <ul class="dropdown-menu">
                                <li>$LoginForm</li>
                            </ul>
                        </li>
                    <% end_if %>
                </ul>
            </div>
        </div><!--/.container-->
    </nav><!--/nav-->
</header><!--/header-->