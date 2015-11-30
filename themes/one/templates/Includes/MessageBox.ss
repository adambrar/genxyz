<div class="row">
    <div class="col-sm-4">
        <div id="messages-select" class="list-group">
            <% if Member.ClassName == "Agent" %>
                <a href="0" class="list-group-item text-center" data-message-id="0">
                    <p class="list-group-item-heading"><em>Create a new Message</em></p>
                </a>
            <% end_if %>
            <% loop Member.MessageThreads %>
                <a href="#$ID" class="list-group-item <% if First %>active<% end_if %>" data-message-id="{$ID}">
                  <h4 class="list-group-item-heading">$Title - <em>$Student.Name</em></h4>
                  <p class="list-group-item-text">$Messages.Last.Content.LimitCharacters(75) - <em>$Messages.Last.Created.Format('H:i M d Y')</em></p>
                </a>
            <% end_loop %>
        </div>
    </div>
    <div id="thread-content" class="col-sm-8">
        <div class="panel panel-default">
            <% with Member.MessageThreads.First %>
                <div class="panel-heading"><h3 class="text-center">$Title</h3></div>
                <ul class="list-group">
                    <% loop Messages %>
                        <li class="list-group-item">
                            <h4><a href="$Writer.viewLink()">$Writer.Name</a><span class="pull-right"><small>$Created.Format('H:i M d Y')</small></h4>
                            $Content
                        </li>
                    <% end_loop %>
                        <li class="list-group-item text-center">
                            $Top.AddMessageForm($ID)
                        </li>
                </ul>
            <% end_with %>
        </div>
    </div>
</div>