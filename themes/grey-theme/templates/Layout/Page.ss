<% include Logo %>
<div class="main" role="main">
	<div class="inner typography line">
        <div id="main-wrapper">
            <div class="container">
                <div id="content">
                    <div class="content-container unit size3of4 lastUnit">
                        <article>
                            <% if $Content %>
                                <h2>$Title</h2>
                                <div class="content">$Content</div>
                                $Form
                            <% else %>
                                <div class="row">
                                    <div class="4u -4u">
                                        <h2>$Title</h2>
                                        $Form
                                    </div>
                                </div>
                            <% end_if %>
                        </article>
                            $PageComments
                    </div>
                </div>
            </div>
        </div>
	</div>
</div>