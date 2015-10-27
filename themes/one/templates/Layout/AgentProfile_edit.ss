<% include EmptyHeader %>
<div id="content">
    <div class="container margin-bottom">
        <div class="wow fadeInLeft margin-bottom">
            <div class="row">
                <div class="col-xs-1"><% if Member.BusinessLogo %><img class="img-responsive img-thumbnail partner-logo" src="{$BaseHref}{$Member.BusinessLogo.Filename}" alt="Logo" /><% end_if %></div>
                <div class="col-xs-10"><h2>$Member.BusinessName</h2></div>
            </div>
        </div>
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#basic">Basic Information</a></li>
            <li><a data-toggle="tab" href="#profile">Profile Page</a></li>
            <li><a data-toggle="tab" href="#service">Services</a></li>
            <li><a data-toggle="tab" href="#partners">Partners</a></li>
        </ul>

        <div class="tab-content">
            <div id="basic" class="tab-pane fade in active">
                $BasicInfo
            </div>
            <div id="profile" class="tab-pane fade">
                $ProfileContent
            </div>
            <div id="service" class="tab-pane fade">
                <% if Member.Services() %>
                    $EditServices
                <% end_if %>
                $AddServices
            </div>
            <div id="partners" class="tab-pane fade">
                $SchoolPartnersForm
            </div>
        </div>
    </div>
</div>