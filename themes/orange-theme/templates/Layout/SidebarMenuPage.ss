<% include Header %>
<div class="main" role="main">
    <div id="main-wrapper">
        <div class="container">
            <div id="content">
                <article>
                    <div class="row">
                        <div class="4u 12u(1)">
                            <% include StudentSidebar %>
                        </div>
                        <div class="4u 8u(2)">
                             <% if $Children %>
                                <% loop $Children %>
                                    <% include ServiceRequest %>
                                <% end_loop %>
                             <% else %>
                                <p>There are noooo children</p>
                             <% end_if %>
                        </div>
                        <div class="4u 4u(2)">
                            <% include StudentLeftBar %>
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </div>
</div>
<% include Footer %>