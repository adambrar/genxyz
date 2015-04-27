<% include Head %>
<body class="$ClassName<% if not $Menu(2) %> no-sidebar<% end_if %>" <% if $i18nScriptDirection %>dir="$i18nScriptDirection"<% end_if %>
<% include Header %>
<div class="main" role="main">
	<div class="inner typography line">
        <div id="main-wrapper">
            <div class="container">
                <div class="row 200%">
                    <div class="9u 12u(2)">
                        <div id="content">
                            <% include BlogSideBar %>
                            <div class="content-container unit size3of4 lastUnit">
                                <article>

                                    <div class="content">
                                    <div id="BlogContent" class="blogcontent typography">

                                    <% include BreadCrumbs %>

                                    <% if SelectedTag %>
                                        <h3><% _t('BlogTree_ss.VIEWINGTAGGED', 'Viewing entries tagged with') %> '$SelectedTag'</h3>
                                    <% else_if SelectedDate %>
                                        <h3><% _t('BlogTree_ss.VIEWINGPOSTEDIN', 'Viewing entries posted in') %> $SelectedNiceDate</h3>
                                    <% else_if SelectedAuthor %>
                                        <h3><% _t('BlogTree_ss.VIEWINGPOSTEDBY', 'Viewing entries posted by') %> $SelectedAuthor</h3>
                                    <% end_if %>
                                    <div class="blog blogentries">
                                    <% if BlogEntries %>
                                        <% loop BlogEntries %>
                                            <% include BlogSummary %>
                                            <hr>
                                        <% end_loop %>
                                    <% else %>
                                        <h2><% _t('BlogTree_ss.NOENTRIES', 'There are no blog entries') %></h2>
                                    <% end_if %>
                                    </div>

                                    <% include BlogPagination %>

                                    </div>
                                    </div>
                                    $Form
                                </article>
                                $PageComments
                            </div>
                        </div>
                    </div>
                    <div class="3u 12u(3)">
                        $SideBarWidget
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