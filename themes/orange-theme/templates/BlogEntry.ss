<% include Head %>
<body class="$ClassName<% if not $Menu(2) %> no-sidebar<% end_if %>" <% if $i18nScriptDirection %>dir="$i18nScriptDirection"<% end_if %>
<% include Header %>
<div class="main" role="main">
	<div class="inner typography line">
        <div id="main-wrapper">
            <div class="container">
                <div class="row 200%">
                        <div id="content">
                            <% include BlogSideBar %>
                            <div class="content-container unit size3of4 lastUnit">
                                <article>
                                    <div id="BlogContent" class="typography">
                                        <% include BreadCrumbs %>

                                        <div class="blogEntry">
                                            <h2 class="postTitle">$Title</h2>
                                            <p class="authorDate"><% _t('BlogEntry_ss.POSTEDBY', 'Posted by') %> <a href="{$authorProfileURL($BlogHolder.OwnerID)}" target="_blank">$Author.XML</a> <% _t('BlogEntry_ss.POSTEDON', 'on') %> $Date.Long | $Comments.Count <% _t('BlogEntry_ss.COMMENTS', 'Comments') %></p>
                                            <% if TagsCollection %>
                                                <p class="tags">
                                                     <% _t('BlogEntry_ss.TAGS', 'Tags:') %> 
                                                    <% loop TagsCollection %>
                                                        <a href="$Link" title="<% _t('BlogEntry_ss.VIEWALLPOSTTAGGED', 'View all posts tagged') %> '$Tag'" rel="tag">$Tag</a><% if not Last %>,<% end_if %>
                                                    <% end_loop %>
                                                </p>
                                            <% end_if %>		
                                            $Content		
                                        </div>

                                        <% if IsOwner %><p class="edit-post"><a href="$EditURL" id="editpost" title="<% _t('BlogEntry_ss.EDITTHIS', 'Edit this post') %>"><% _t('BlogEntry_ss.EDITTHIS', 'Edit this post') %></a> | <a href="$Link(unpublishPost)" id="unpublishpost"><% _t('BlogEntry_ss.UNPUBLISHTHIS', 'Unpublish this post') %></a></p><% end_if %>

                                        $PageComments
                                    </div>

                                </article>
                            </div>
                        </div>
                </div>
            </div>
        </div>
	</div>
</div>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
<script>
$(function() {	
    $("a.dropdown").click(function() {
        var ul = $(this).next(),
                clone = ul.clone().css({"height":"auto"}).appendTo("body"),
                height = ul.css("height") === "0px" ? ul[0].scrollHeight + "px" : "0px";

        clone.remove();
        ul.animate({"height":height});
        return false;
    });

});
</script>
<% include Footer %>
    
</body>
</html>