<% include EmptyHeader %>
<section id="agent-results">
    <div class="container">
        <div class="text-center">
            <h3>$Title</h3>
            <p>$Content</p>
        </div>
        <div class="col-sm-3">
            <a href="search" class="btn btn-default"><i class="fa fa-arrow-left"></i> Go Back To Main Search</a>
            $AgentFilter
        </div>
        <div id="results-section" class="col-sm-8">
            <% include AgentResults %>            
        </div>
    </div>
</section>