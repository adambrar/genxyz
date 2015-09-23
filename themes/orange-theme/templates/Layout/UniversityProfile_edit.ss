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
                                        <div class="2u"><a href="#" class="image fit"><img src="{$BaseHref}{$Member.getLogoFile($Member.BusinessLogoID).Filename()}" alt="Logo" /></a></div>
                                        <div class="10u"><h2>$Member.BusinessName</h2></div>
                                    </div>
                                    <ul class="tabs">
                                        <li class="tab-link current" data-tab="tab-1">Basic Info</li>
                                        <li class="tab-link" data-tab="tab-2">Profile Content</li>
                                        <li class="tab-link" data-tab="tab-3">Academic Programs</li>
                                        <li class="tab-link" data-tab="tab-4">Tuition</li>
                                        <li class="tab-link" data-tab="tab-5">Application Links</li>
                                    </ul>

                                    <div id="tab-1" class="tab-content current">
                                        $BasicInfo
                                    </div>
                                    <div id="tab-2" class="tab-content">
                                        $ProfileContent
                                    </div>
                                    <div id="tab-3" class="tab-content">
                                        <% if $Member.Programs() %>
                                        $EditAcademicProgramsForm
                                        <% end_if %>
                                        $AddAcademicProgramsForm
                                    </div>
                                    <div id="tab-4" class="tab-content">
                                        $TuitionForm
                                    </div>
                                    <div id="tab-5" class="tab-content">
                                        $ProfileLinks
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
    $('.edit-program-select select').change(function(){$.getJSON(location.origin + '/silver/partners-portal/ajaxProgramRequest',{'ProgramID':this.value},function(data){$.each(data,function(key,val){if(val.value){$('.'+val.title).val(val.value);}else{$('.'+val.title).val('');}});});});
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