<% if SessionMessage %>
    <div class="panel panel-{$SessionMessage.Context} margin-top text-center">
        <div class="panel-heading">
            $SessionMessage.Context.UpperCase()
        </div>
        <div class="panel-body">$SessionMessage.Content</div>
    </div>
<% end_if %>