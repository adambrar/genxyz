<div id="header-wrapper">
    <header id="header" class="container">
            <div id="logo">
                <h1><img class="header-img" src="$ThemeDir/images/GenXYZ_dc.jpg" alt=""/><a href="$BaseHref">$SiteConfig.Title</a></h1>
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
                            <li><a id="logout-button" href="Security/logout" title="Logout!">Logout</a>
                        <% end_if %>
                    <% else %>
                        <a id="langbar-button" href="home" title="Go Home!"><%t NavigationTemplate.GENXYZ "GenXYZ" %></a>
                    <% end_if %>
                </li>
                <li><% include LanguageSelector %><li>
            </ul>
        </div>
    </div> 
</div>