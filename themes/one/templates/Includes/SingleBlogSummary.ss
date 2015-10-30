<header class="entry-header">
    <h2 class="entry-title"><a href="$Link">$Title</a></h2>
    <% if authorName %><span class="entry-author"><i class="fa fa-pencil"></i> <a href="{$authorProfileURL($BlogHolder.OwnerID)}" title="View authors profile">$authorName</a></span><% end_if %>
    <% if Topic %><span class="entry-category"><i class="fa fa-folder-o"></i> <a href="{$Topic.Link}" title="View more posts in this category">$Topic.Title</a></span><% end_if %>
    <span class="entry-comments"><i class="fa fa-comments-o"></i> <a class="tohash" href="$Link#PageComments_holder" title="See comments">$Comments.Count</a></span>
</header>
<div class="entry-content">
    <P>$Content.LimitCharacters(200) - <em><a>$Date.Format('d F Y')</a></em></P>
</div>