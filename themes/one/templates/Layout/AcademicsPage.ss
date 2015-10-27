<div class="row">
    <h1 class="text-center">$Title</h1>
    <div class="col-sm-3 wow fadeInRight">
        $Content
        $FilterAcademics
    </div>
    <div class="col-sm-6">
        <% loop PaginatedUniversities %>
            <div class="panel panel-primary wow fadeInRight" data-wow-delay="<% if Pos < 5 %>{$Pos}<% else %>3<% end_if %>00ms">
            <a href="$showProfilePageLink($ID)">
                <% if BusinessLogo %><img class="img-responsive img-thumbnail partner-logo pull-left" style="height:5em;" src="{$BaseHref}{$BusinessLogo.Filename}" alt="Logo" /><% end_if %>
                <h4 class="panel-heading">$BusinessName</h4>
                <p class="panel-body">$PartnersProfile.MisionStatement</p>
            </a>
            </div>
        <% end_loop %>
        
        <% if PaginatedUniversities.MoreThanOnePage %>
            <div class="text-center wow fadeIn">
                <ul class="pagination">
                    <% if PaginatedUniversities.NotFirstPage %>
                        <li>
                            <a href="$PaginatedUniversities.PrevLink" title="View the previous page">«</a>
                        </li>
                    <% else %>	
                        <li class="disabled">
                            <a>«</a>
                        </li>
                    <% end_if %>

                    <% loop PaginatedUniversities.PaginationSummary(4) %>
                        <% if CurrentBool %>
                            <li class="active"><a>$PageNum</a></li>
                        <% else %>
                            <% if Link %>
                                <li>
                                    <a href="$Link">$PageNum</a>
                                </li>
                            <% else %>
                                <li class="disabled"><a class="disabled">&hellip;</a></li>
                            <% end_if %>
                        <% end_if %>
                    <% end_loop %>

                    <% if PaginatedUniversities.NotLastPage %>
                        <li>
                            <a href="$PaginatedUniversities.NextLink" title="View the next page">»</a>
                        </li>
                    <% else %>
                        <li class="disabled">
                            <a>»</a>
                        </li>
                    <% end_if %>
                </ul>
            </div>
        <% end_if %>
    </div>
    <div class="col-sm-3 wow fadeInLeft">
        <h1>Sponsored Content</h1>        
    </div>
</div>
