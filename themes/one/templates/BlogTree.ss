<% include Head %>
<body id="blog" class="$ClassName" <% if $i18nScriptDirection %>dir="$i18nScriptDirection"<% end_if %>>
    <% include EmptyHeader %>
    <div id="content">
        <div class="container margin-bottom">
            <h2>$Title</h2>
            <article>
                <% include BreadCrumbs %>
                <div class="row">
                    <div class="col-md-2 wow fadeInLeft" data-wow-delay="200ms">
                        <div class="row">
                            <div class="col-md-12 col-xs-4">
                                <% if isSignedIn %>
                                    <h4>Blog Admin</h4>
                                    <ul class="list-unstyled">
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
                    <div class="col-md-6">
                        <% loop EntriesByCategory %>
                            <div class="wow fadeInRight" data-wow-delay="400ms">
                                <% include SingleBlogSummary %>
                            </div>
                        <% end_loop %>
                        <% include BlogPagination %>
                    </div>
            </article>
        </div><!-- end container -->
    </div><!-- end content -->
    <% include Footer %>
        
</body>
</html>
