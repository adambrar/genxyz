<% include EmptyHeader %>
<div id="content">
    <div class="container margin-bottom">
        <div class="wow fadeInLeft margin-bottom">
            <div class="row">
                <div class="col-xs-1"><% if Member.Logo %><img class="img-responsive img-thumbnail partner-logo" src="{$BaseHref}{$Member.Logo.Filename()}" alt="Logo" /><% end_if %></div>
                <div class="col-xs-8"><h2>$Member.Name</h2></div>
                <div class="col-xs-3 pull-right"><a class="btn btn-warning btn-lg pull-right" target="_blank" href="{$PreviewPorfileLink}">Preview your profile!</a></div>
            </div>
        </div>
        <% include SessionMessage %>
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#basic">Basic Information</a></li>
            <li><a data-toggle="tab" href="#profile">Profile Content</a></li>
            <li><a data-toggle="tab" href="#programs">Academic Programs</a></li>
            <li><a data-toggle="tab" href="#partners">Partners</a></li>
        </ul>

        <div class="tab-content">
            <div id="basic" class="tab-pane fade in active">
                $BasicInfo
            </div>
            <div id="profile" class="tab-pane fade">
                $ProfileLinks
            </div>
            <div id="programs" class="tab-pane fade">
                <div class="row">
                <% if $Member.Programs() %>
                    <div class="col-sm-6">
                        $AddPrograms
                    </div>
                    <div class="col-sm-6">
                        $EditPrograms
                    </div>
                <% else %>
                    <div class="col-sm-6 col-sm-offset-3">
                        $AddPrograms
                    </div>
                <% end_if %>
                </div>
                $AddAcademicProgramsForm
            </div>
            <div id="partners" class="tab-pane fade">
                $SchoolPartnersForm
                $AgentPartnersForm
            </div>
        </div>
    </div>
</div>