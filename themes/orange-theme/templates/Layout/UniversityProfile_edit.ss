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
                                        <div class="2u"><% if Logo %><a href="#" class="image fit"><img src="{$BaseHref}{$Logo.Filename}" alt="Logo" /></a><% end_if %></div>
                                        <div class="10u"><h2>$Member.BusinessName</h2></div>
                                    </div>
                                    <ul class="tabs">
                                        <li class="tab-link current" data-tab="tab-1">Basic Info</li>
                                        <li class="tab-link" data-tab="tab-2">Profile Content</li>
                                        <li class="tab-link" data-tab="tab-3">Academic Programs</li>
                                        <li class="tab-link" data-tab="tab-5">Application Links</li>
                                    </ul>

                                    <div id="tab-1" class="tab-content current">
                                        $BasicInfo
                                    </div>
                                    <div id="tab-2" class="tab-content">
                                        $ProfileContent
                                    </div>
                                    <div id="tab-3" class="tab-content">
                                        List of academic programs in alphabetic order.
                                        <ul>
                                            <li><a>Program 1</a></li>
                                            <li><a>Program 2</a></li>
                                            <li><a>Program 3</a></li>
                                            <li><a>Program 4</a></li>
                                            <li><a>Program 5</a></li>
                                        </ul>
                                    </div>
                                    <div id="tab-4" class="tab-content">
                                        
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

<% include EmptyFooter %>