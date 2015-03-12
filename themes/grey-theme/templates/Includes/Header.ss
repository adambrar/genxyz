<div id="header-wrapper">
    <header id="header" class="container">
            <div id="logo">
                <h1><a href="$BaseHref">$SiteConfig.Title</a></h1>
            </div>
            <% if $SearchForm %>
                <span class="search-dropdown-icon">L</span>
                <div class="search-bar">
                    $SearchForm
                </div>
            <% end_if %>
            <% include Navigation %>
    </header>
</div>