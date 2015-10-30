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
                    <li><a href="home">Go Home</a></li>
                    <% with Page(forums) %>
                    <li class="$LinkingMode"><a href="forums">Forums</a></li>
                    <% end_with %>
                    <% with Page(genxyz) %>
                    <li class="$LinkingMode"><a href="$Link">Blog</a></li>
                    <% end_with %>
                </ul>
            </div>
        </div><!--/.container-->
    </nav><!--/nav-->
</header><!--/header-->