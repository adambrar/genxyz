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
                                        <div class="10u"><h2>$Member.BusinessName</h2></div>>
                                    </div>
                                    <ul class="tabs">
                                        <li class="tab-link current" data-tab="tab-1">Home</li>
                                        <li class="tab-link" data-tab="tab-2">About</li>
                                        <li class="tab-link" data-tab="tab-3">Academic Programs</li>
                                        <li id="search-bar" data-tab="tab-5">Apply</li>
                                    </ul>

                                    <div id="tab-1" class="tab-content current">
                                        <div class="row">
                                            <div class="3u 6u(1)">
                                                <a href="http://{$Member.BusinessWebsite}">$Member.BusinessWebsite</a>
                                            </div>
                                            <div class="9u 12u(2)">
                                                <p>Videos!</p>
                                                <p>Photos!</p>
                                            </div>
                                        </div>
                                        <h2>Testimonials!</h2>
                                    </div>
                                    <div id="tab-2" class="tab-content">
                                        <h2>Mission Statement</h2>
                                        <p>$ProfilePage.MissionStatement</p>
                                        <h2>Values</h2>
                                        <p>$ProfilePage.Values</p>
                                        <h2>Vision</h2>
                                        <p>$ProfilePage.Vision</p>
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
                                        <ul>
                                            <li><a class="button medium icon fa-book" href="http://{$ProfilePage.AdmissionRequirements}" target="_blank">Admission Requirements</a></li>
                                            <li><a class="button medium icon fa-edit" href="http://{$ProfilePage.EnglishRequirements}" target="_blank">English Requirements</a></li>
                                            <li><a class="button medium icon fa-clock-o" href="http://{$ProfilePage.ProcessingTime}" target="_blank">Processing Time</a></li>
                                            <li><a class="button medium icon fa-dollar" href="http://{$ProfilePage.Fees}" target="_blank">Fees</a></li>
                                            <li><a class="button medium icon fa-file-text-o" href="http://{$ProfilePage.Application}" target="_blank">Application</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="3u 12u(2)">
                                    <h2>Static Promo Space</h2>
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