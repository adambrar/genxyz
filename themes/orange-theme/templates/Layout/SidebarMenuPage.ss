<% include Header %>
<div class="main" role="main">
    <div id="main-wrapper">
        <div class="container">
            <div id="content">
                <article>
                    <div class="row content-box-light">
                        <div class="4u 12u(1) gutters-fix">
                            <div class="small-content-box">
                                <% include StudentSidebar %>
                            </div>                        
                        </div>
                        <div class="4u 8u(3) gutters-fix">
                            <div class="small-content-box">
                                <% if $Children %>
                                    <% loop $Children %>
                                        <% include ServiceRequest %>
                                    <% end_loop %>
                                <% else %>
                                    <p>There are noooo children</p>
                                <% end_if %>
                            </div>
                        </div>
                        <div class="4u 4u(2) gutters-fix">
                            <% include StudentLeftBar %>
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </div>
</div>
<% include Footer %>