<% include Header %>
<div class="main" role="main">
	<div class="inner typography line">
        <div id="main-wrapper">
            <div class="container">
                <div id="content">
                    <div class="content-container unit size3of4 lastUnit">
                        <article>
                            <div class="content">$Content</div>
                            
                            <div class="blog blogentries">
                                <% loop $LatestBlogPosts %>
                                    <% include BlogSummary %>
                                <% end_loop %>
                            </div>
                            
                            $Form
                            $PageComments
                        </article>
                    </div>
                </div>
            </div>
        </div>
	</div>
</div>
<% include Footer %>