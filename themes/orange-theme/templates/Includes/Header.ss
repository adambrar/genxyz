<div id="header-wrapper">
    <header id="header" class="container">
            <div id="logo">
                <h1><a href="$BaseHref"><img class="header-img" src="$ThemeDir/images/GenXYZ_dc.jpg" alt=""/></a><a class="site-title" href="$BaseHref">$SiteConfig.Title</a></h1>
            </div>
            <% if $SearchForm %>
                <span class="search-dropdown-icon">L</span>
                <div class="search-bar">
                    $SearchForm
                </div>
            <% end_if %>
            <% include Navigation %>
    </header>
    <div id="lang-bar">
        <div id="lang-selector" class="container">
            <ul>
                <li class="link">
                    <% if $menuShown = "Welcome" %>
                        <% if isSignedIn %>
                            <a id="langbar-button" href="{$profilePageLink}" title="MyProfile"><%t NavigationTemplate.MYPROFILE "MyProfile" %></a></li>
                            <li><a onclick="$.get('http://localhost/ajax/chat?logout=true');" id="logout-button" href="Security/logout" title="Logout!">Logout</a>
                        <% else %>
                            <a id="langbar-button" href="Security/login" title="Login to your account"><%t NavigationTemplate.LOGINBUTTON "Login" %></a></li>
                        <% end_if %>
                    <% else %>
                        <a id="langbar-button" href="home" title="Go Home!"><%t NavigationTemplate.GENXYZ "GenXYZ" %></a>
                        <% if isSignedIn %>

                            </li><li><a onclick="$.get('http://localhost/ajax/chat?logout=true');" id="logout-button" href="Security/logout" title="Logout!">Logout</a>
                        <% end_if %>
                    <% end_if %>
                </li>
                <li><% include LanguageSelector %><li>
            </ul>
        </div>
    </div> 
</div>