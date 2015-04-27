<% include Header %>
<div class="main" role="main">
    <div id="main-wrapper">
        <div class="container">
            <div id="content">
                <div class="content-container unit size3of4 lastUnit">
                    <article>
                        <div class="content">
                            <div class="row">
                                <div class="3u 12u(3)">
                                    <h2>Most Popular</h2>
                                    <h1>Popular Agent 1</h1>
                                    <p>quick description</p>
                                    <h1>Popular Uni</h1>
                                    <p>descriptive words</p>
                                    <h1>Important Scholarship</h1>
                                    <p>description of scholarship</p>
                                </div>
                                <div class="6u 12u(1)">
                                    <ul class="tabs">
                                        <li class="tab-link current" data-tab="tab-1">Universities</li>
                                        <li class="tab-link" data-tab="tab-2">Agents</li>
                                        <li class="tab-link" data-tab="tab-3">Scholarships</li>
        <!--                                <li class="tab-link" data-tab="tab-4">Search Results</li>-->
                                        <li id="search-bar" data-tab="tab-5">Search Bar</li>
                                    </ul>

                                    <div id="tab-1" class="tab-content current">
                                        $FilterUniversities
                                        <p>List of universities with links to pages and more info. options for filtering.</p>
                                    </div>
                                    <div id="tab-2" class="tab-content">
                                        List of agencies same as universities
                                    </div>
                                    <div id="tab-3" class="tab-content">
                                        $FilterScholarships
                                        Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                                    </div>
                                    <div id="tab-4" class="tab-content">
                                        Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                                    </div>
                                    <div id="tab-5" class="tab-content">
                                        $SearchAcademics
                                    </div>
                                </div>
                                <div class="3u 12u(2)">
                                    <h2>New Feed</h2>
                                    <h1>News 1</h1>
                                    <p>Some details</p>
                                    <h1>News 2</h1>
                                    <p>More exciting news</p>
                                </div>
                        </div>

                    </article>
                </div>
            </div>
        </div>
    </div>
</div>
            
<script src="{$ThemeDir}/javascript/tabbed.js"></script>

<% include Footer %>