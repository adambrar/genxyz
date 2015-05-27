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
                                        <div class="2u"><% if Logo %><a href="#" class="image fit"><img src="/Silverstripe/{$Logo.Filename}" alt="Logo" /></a><% end_if %></div>
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
                                        List of agents services.
                                        <ul>
                                            <li>
                                                <h3>Service 1</h3>
                                                <p>Description of said service.</p>
                                            </li>
                                            <li>
                                                <h3>Service 2</h3>
                                                <p>Description of said service.</p>
                                            </li>
                                            <li>
                                                <h3>Service 3</h3>
                                                <p>Description of said service.</p>
                                            </li>
                                            <li>
                                                <h3>Service 4</h3>
                                                <p>Description of said service.</p>
                                            </li>
                                            <li>
                                                <h3>Service 5</h3>
                                                <p>Description of said service.</p>
                                            </li>
                                        </ul>
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