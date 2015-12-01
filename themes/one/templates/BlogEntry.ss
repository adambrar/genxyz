<% include Head %>
<body id="blog" class="$ClassName" <% if $i18nScriptDirection %>dir="$i18nScriptDirection"<% end_if %>>
    <% include EmptyHeader %>
    <div id="content">
        <div class="container margin-bottom">
            <div class="blog-post blog-large">
                <article>
                    <% include BreadCrumbs %>
                    <div class="row">
                        <div class="col-md-2 wow fadeInLeft" data-wow-delay="200ms">
                            <div class="row">
                                <div class="col-md-12 col-xs-4">
                                    <% if CurrentUserIsOwner %>
                                        <h4>Blog Admin</h4>
                                        <ul class="list-unstyled">
                                        <li>| <a href="$EditURL" id="editpost" title="<% _t('BlogEntry_ss.EDITTHIS', 'Edit this post') %>"><% _t('BlogEntry_ss.EDITTHIS', 'Edit this post') %></a></li>
                                        <li>| <a href="$Link(unpublishPost)" id="unpublishpost"><% _t('BlogEntry_ss.UNPUBLISHTHIS', 'Unpublish this post') %></a></li>
                                        <li>| <a href="$BlogHolder.postURL" id="postlink">Publish new post</a></li>

                                    <% end_if %>
                                </div>
                                <div class="col-md-12 col-xs-4">
                                <% if TagsCollection %>
                                    <h4>Tags</h4>
                                    <ul class="list-unstyled">
                                    <% loop TagsCollection %>
                                        <li>| <a href="$Link" title="<% _t('BlogEntry_ss.VIEWALLPOSTTAGGED', 'View all posts tagged') %> '$Tag'" rel="tag">$Tag</a></li>
                                    <% end_loop %>
                                    </ul>
                                <% end_if %>
                                </div>
                                <div class="col-md-12 col-xs-4">
                                <% if $BlogHolder.Dates %>
                                    <h4>Archive</h4>
                                    <ul class="list-unstyled">
                                    <% loop $BlogHolder.Dates %>
                                        <li>| <a href="$Link" title="View posts from $Date.Format(F) $Date.Year" rel="tag">$Date.Format(F) $Date.Year</a></li>
                                    <% end_loop %>
                                    </ul>
                                <% end_if %>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8 wow fadeInRight" data-wow-delay="100ms">
                            <header class="entry-header">
                                <div class="entry-date">$Date.Format('d F Y')</div>
                                <h2 class="entry-title"><a href="$Link">$Title</a></h2>
                                <% if Author %><% with Author %><span class="entry-author"><i class="fa fa-pencil"></i> <a href="{$viewLink()}" title="View authors profile">$FirstName $Surname</a><% end_with %></span><% end_if %>
                                <% if Topic %><span class="entry-category"> <i class="fa fa-folder-o"></i> <a href="{$Topic.Link}" title="View more posts in this category">$Topic.Title</a></span><% end_if %>
                                <span class="entry-comments"> <i class="fa fa-comments-o"></i> <a class="tohash" href="$Link#PageComments_holder" title="See comments">$Comments.Count</a></span>
                            </header>
                            <div class="entry-content">
                                <P>$Content</P>
                            </div>
                            <footer id="PageComments_holder" class="entry-meta col-md-8 col-md-offset-2">
                                $PageComments
                            </footer>
                        </div>
                </article>
            </div>
        </div><!-- end container -->
    </div><!-- end content -->
    <% include Footer %>
        
</body>
</html>
