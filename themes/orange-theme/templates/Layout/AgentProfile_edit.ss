<% include Header %>
<div class="main" role="main">
    <div id="main-wrapper">
        <div class="container">
            <div id="content">
                <div class="content-container unit size3of4 lastUnit">
                    <article>
                        <div class="content">
                            <div class="row content-box-dark">
                                <div class="9u 12u(1)">
                                    <div class="row">
                                        <div class="2u"><% if Member.BusinessLogo %><a href="#" class="image fit"><img src="{$BaseHref}{$Member.BusinessLogo.Filename}" alt="Logo" /></a><% end_if %></div>
                                        <div class="10u"><h2>$Member.BusinessName</h2></div>
                                    </div>
                                    <ul class="tabs">
                                        <li class="tab-link current" data-tab="tab-1">Basic Information</li>
                                        <li class="tab-link" data-tab="tab-2">Profile Page</li>
                                        <li class="tab-link" data-tab="tab-3">Services</li>
                                    </ul>

                                    <div id="tab-1" class="tab-content current">
                                        $BasicInfo
                                    </div>
                                    <div id="tab-2" class="tab-content">
                                        $ProfileContent
                                    </div>
                                    <div id="tab-3" class="tab-content">
                                        <% if Member.Services() %>
                                            $EditServices
                                        <% end_if %>
                                        $AddServices
                                    </div>
                                </div>
                                <div class="3u 12u(2)">
                                    <p>Static Promo Space</p>
                                </div>
                            </div>
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </div>
</div>
            
<script src="{$ThemeDir}/javascript/tabbed.js"></script>
<script type="text/javascript">
    $('.edit-service-select select').change(function() {
        $.getJSON(location.origin + '/silver/partners-portal/ajaxServiceRequest',
                {'ServiceID':this.value},
                function(data) {
                    $.each(data,function(key,val) {
                        if(val.value) {
                            $('.'+val.title).val(val.value);
                            if(val.title == 'DescriptionField') {
                                tinymce.getInstanceById('Form_EditAcademicServiceForm_Description').setContent(val.value);
                            }
                        } else {
                            $('.'+val.title).val('');
                        }
                    });
        });
    });
</script>
<script type="text/javascript">
    jQuery(".content-slider").click(function(){
        jQuery(".fa-rotate-90").removeClass("fa-rotate-90");
        if(!jQuery(this).parent().find(".hidden-content").is(":visible")) {
            jQuery(this).children().addClass("fa-rotate-90");
        }
        jQuery(".hidden-content").not(jQuery(this).next(".hidden-content")).slideUp(750);
        jQuery(this).next(".hidden-content").slideToggle(750);
    });
</script> 
<% include EmptyFooter %>