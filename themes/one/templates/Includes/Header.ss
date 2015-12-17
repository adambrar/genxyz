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
                    <div class="media-body"><h2 id="header-title" style="font-family:'Lucida Console', Monaco, monospace;color:white;">GenXYZ</h2></div>
                </div>
            </div>

            <div class="collapse navbar-collapse navbar-right">
                <ul class="nav navbar-nav">
                    <% if CurrentMember %><li class=""><a href="{$CurrentMember.editLink()}">My Profile</a></li><% end_if %>
                    <li class="scroll active"><a href="#home">Home</a></li>
                    <li class="scroll"><a href="#about">About</a></li>
                    <li class="scroll"><a href="#services">Services</a></li>
                    <% if NotTrue %><li class="scroll"><a href="#blog">Blog</a></li><% end_if %>
                    <li class="scroll"><a href="#get-in-touch">Contact</a></li>
                </ul>
            </div>
        </div><!--/.container-->
    </nav><!--/nav-->
</header><!--/header-->