<!DOCTYPE html>

<!--[if !IE]><!-->
<html lang="$ContentLocale">
<!--<![endif]-->
<!--[if IE 6 ]><html lang="$ContentLocale" class="ie ie6"><![endif]-->
<!--[if IE 7 ]><html lang="$ContentLocale" class="ie ie7"><![endif]-->
<!--[if IE 8 ]><html lang="$ContentLocale" class="ie ie8"><![endif]-->

<head>
	<% base_tag %>
	<title><% if $MetaTitle %>$MetaTitle<% else %>$Title<% end_if %> &raquo; $SiteConfig.Title</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	$MetaTags(false)
	<!--[if lt IE 9]>
	<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
    <script src="$ThemeDir/javascript/jquery.min.js"></script>
	<script src="$ThemeDir/javascript/bootstrap.min.js"></script>
    <script src="$ThemeDir/javascript/jquery.dropotron.min.js"></script>
    <script src="$ThemeDir/javascript/skel.min.js"></script>
    <script src="$ThemeDir/javascript/skel-layers.min.js"></script>
    <script src="$ThemeDir/javascript/init.js"></script>
    <noscript>
        <% require themedCSS('bootstrap.min') %>
        <% require themedCSS('skel') %>
        <% require themedCSS('style') %>
        <% require themedCSS('style-desktop') %>
        <% require themedCSS('comments') %>
        <% require themedCSS('font-awesome.min') %>
    </noscript>
	<link rel="shortcut icon" href="$ThemeDir/images/favicon.ico" />
</head>
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
                                            <p class="authorDate"><% _t('BlogEntry_ss.POSTEDBY', 'Posted by') %> $Author.XML <% _t('BlogEntry_ss.POSTEDON', 'on') %> $Date.Long | $Comments.Count <% _t('BlogEntry_ss.COMMENTS', 'Comments') %></p>
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