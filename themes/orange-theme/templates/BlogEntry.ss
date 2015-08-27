<% include Head %>
<body class="$ClassName<% if not $Menu(2) %> no-sidebar<% end_if %>" <% if $i18nScriptDirection %>dir="$i18nScriptDirection"<% end_if %>
<% include Header %>
<div class="main" role="main">
    <div id="main-wrapper">
        <div class="container">
            <div id="content">
                <article>
                    <div class="row content-box-light">
                        <div class="10u -1u 12u(1) gutters-fix">
                            <div class="small-content-box">
                                <% include BreadCrumbs %>

                                <div class="blogEntry">
                                    <h2 class="postTitle">$Title</h2>
                                    <p class="authorDate"><% if authorName %><% _t('BlogEntry_ss.POSTEDBY', 'Posted by') %> <a href="{$authorProfileURL($BlogHolder.OwnerID)}" target="_blank">$authorName </a><% else %>Posted <% end_if %><% _t('BlogEntry_ss.POSTEDON', 'on') %> $Date.Long | $Comments.Count <% _t('BlogEntry_ss.COMMENTS', 'Comments') %></p>
                                    <p class="tags">
                                        <% if Topic %>
                                            <% with Topic %>
                                                Topic: <a href="{$Link}">$Title</a>
                                            <% end_with %>
                                        <% end_if %>
                                        <% if TagsCollection %>
                                            <% _t('BlogEntry_ss.TAGS', 'Tags:') %> 
                                            <% loop TagsCollection %>
                                                <a href="$Link" title="<% _t('BlogEntry_ss.VIEWALLPOSTTAGGED', 'View all posts tagged') %> '$Tag'" rel="tag">$Tag</a><% if not Last %>,<% end_if %>
                                            <% end_loop %>
                                        <% end_if %>
                                    </p>
                                    <div class="blog-content">$Content</div>
                                </div>

                                <% if CurrentUserIsOwner %><p class="edit-post"><a href="$EditURL" id="editpost" title="<% _t('BlogEntry_ss.EDITTHIS', 'Edit this post') %>"><% _t('BlogEntry_ss.EDITTHIS', 'Edit this post') %></a> | <a href="$Link(unpublishPost)" id="unpublishpost"><% _t('BlogEntry_ss.UNPUBLISHTHIS', 'Unpublish this post') %></a></p><% end_if %>
                            </div>
                            <div class="10u -1u 12u(2) gutters-fix">
                                <div id="PageComments_holder" class="small-content-box">$PageComments</div>
                            </div>
                        </div>
                    </div>

                </article>
            </div>
        </div>
    </div>
</div>

<% include Footer %>
    
</body>
</html>