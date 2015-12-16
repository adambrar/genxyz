<% with MessageThread %>
    <div class="panel-heading"><h3 class="text-center">$Title</h3></div>
    <ul class="list-group">
        <li class="list-group-item text-center">
            $AddMessageForm
        </li>
        <% if Messages %>
            <% loop Messages.Sort(Created).Reverse %>
                <li class="list-group-item">
                    <h4><a href="$Writer.viewLink()">$Writer.Name</a><span class="pull-right"><small>$Created.Format('h:i M d Y')</small></h4>
                    $Content
                </li>
            <% end_loop %>
        <% end_if %>
    </ul>
<% end_with %>