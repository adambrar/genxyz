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
                <div class="navbar-brand media" style="margin:0px;">
                    <div class="media-left media-middle"><a href="/"><img class="media-object" src="{$ThemeDir}/images/GenXYZ_dc.jpg" style="height:3.4em;border-radius:3px;"/></a></div>
                    <div class="media-body hidden-xs"><h2 id="header-title" style="font-family:'Lucida Console', Monaco, monospace;color:white;">GenXYZ</h2></div>
                </div>
            </div>
            
            <div class="collapse navbar-collapse navbar-right">
                <ul class="nav navbar-nav">
                    <% if CurrentMember %><li class=""><a href="{$CurrentMember.editLink()}">My Profile</a></li><% end_if %>
                    <li><a href="home">Go Home</a></li>
                    <% with Page(forums) %>
                    <li class="$LinkingMode"><a href="forums">Forums</a></li>
                    <% end_with %>
                    <% if NotTrue %><% with Page(genxyz) %>
                    <li class="$LinkingMode"><a href="$Link">Blog</a></li>
                    <% end_with %><% end_if %>
                    <% if CurrentMember %>
                        <li><a href="Security/logout">Logout</a></li>
                    <% else %>
                        <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Login</a>
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