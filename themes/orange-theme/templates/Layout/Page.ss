<% include Logo %>
<div class="main" role="main">
    <div id="main-wrapper">
        <div class="container">
            <div id="content">
                <article>
                    <% if $Content %>
                        <div class="row content-box-light">
                            <div class="8u -2u 12u(1) gutters-fix">
                                <div class="small-content-box">
                                    <h2>$Title</h2>
                                    <div class="content">$Content</div>
                                    $Form
                                </div>
                            </div>
                        </div>
                    <% else %>
                        <div class="row">
                            <div class="8u -2u 12u(1) gutters-fix content-box-light">
                                <div class="small-content-box">
                                    <h2>$Title</h2>
                                    $Form
                                </div>
                            </div>
                        </div>
                        </div>
                    <% end_if %>
                </article>
                    $PageComments
            </div>
        </div>
    </div>
</div>
<% include EmptyFooter %>