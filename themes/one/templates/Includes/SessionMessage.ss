<% if SessionMessage %>
    <div class="panel panel-{$SessionMessage.Context} margin-top text-center">
        <div class="panel-heading">
            <% if SessionMessage.Title %>$SessionMessage.Title<% else %>$SessionMessage.Context.UpperCase()<% end_if %>
        </div>
        <div class="panel-body">$SessionMessage.Content</div>
    </div>
<% end_if %>