    <% if PaginatedResults.MoreThanOnePage %><div class="pagination-wrapper text-right" data-pagination-pages="{$PaginatedResults.TotalPages}" data-search-type="{$SearchType}"></div><% end_if %>
<% loop PaginatedResults %>
    <div class="panel panel-primary wow fadeInRight" data-wow-delay="<% if Pos < 5 %>{$Pos}<% else %>3<% end_if %>00ms">
    <a href="$showProfilePageLink($ID)">
        <% if BusinessLogo %><img class="img-responsive img-thumbnail partner-logo pull-left" style="height:5em;" src="{$BaseHref}{$BusinessLogo.Filename}" alt="Logo" /><% end_if %>
        <h4 class="panel-heading">$BusinessName</h4>
        <p class="panel-body">$PartnersProfile.MisionStatement</p>
    </a>
    </div>
<% end_loop %>
    <% if PaginatedResults.MoreThanOnePage %><div class="pagination-wrapper text-right" data-pagination-pages="{$PaginatedResults.TotalPages}" data-search-type="{$SearchType}"></div><% end_if %>