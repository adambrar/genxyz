<div id="header-wrapper">
    <header id="header" class="container">
            <div id="logo">
                <h1><img class="header-img" src="/photos/logo_files/GenXYZ_dc_BW.png" alt=""/><a href="$BaseHref">$SiteConfig.Title</a></h1>
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
            <% if isSignedIn %>
                <li class="link">
                    <% if $menuShown = "Student" %>
                        <a id="langbar-button" href="home"><%t NavigationTemplate.GENXYZ "GenXYZ" %></a></li>
                    <% else %>
                        <a id="langbar-button" href="{$profilePageLink}" title="MyProfile"><%t NavigationTemplate.MYPROFILE "MyProfile" %></a>
                    <% end_if %>
                </li>
            <% end_if %>
            <li><% include LanguageSelector %><li>
        </ul>
        </div>
    </div> 
</div>