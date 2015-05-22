<% include Logo %>
<div class="main" role="main">
    <div id="main-wrapper">
        <div class="container">
            <div id="content">
                <article>
                    <% if $Content %>
                        <h2>$Title</h2>
                        <div class="content">$Content</div>
                        $Form
                    <% else %>
                        <div class="row">
                            <div class="8u -2u 12u(1)">
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