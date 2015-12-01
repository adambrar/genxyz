<div class="blog-post blog-media">
	<article class='media clearfix'>
        <div class="media-body">
            <header class="entry-header">
                <div class="entry-date">$Date.Format('d F Y')</div>
                <h2 class="entry-title"><a href="$Link">$Title</a></h2>
            </header>

            <div class="entry-content">
                <P>$Content.LimitCharacters(200)</P>
                <a class="btn btn-primary" href="$Link">Read More</a>
            </div>

            <footer class="entry-meta pull-right">
                <% if authorName %><span class="entry-author"><i class="fa fa-pencil"></i> <a href="{$authorProfileURL($BlogHolder.OwnerID)}">$authorName</a></span><% end_if %>
                <% if Topic %><span class="entry-category"><i class="fa fa-folder-o"></i> <a href="$Topic.Link">$Topic.Title</a></span><% end_if %>
                <span class="entry-comments"><i class="fa fa-comments-o"></i> <a href="$Link#PageComments_holder">$Comments.Count</a></span>
                <% if CurrentUserIsOwner %> <i class="fa fa-edit"></i> <a href="{$EditURL}" title="Edit this post">Edit</a> <i class="fa fa-circle"></i> <a href="{$Link(unpublishPost)}" title="Unpublish this post">Delete</a><% end_if %>
            </footer>
        </div>
    </article>
</div>
