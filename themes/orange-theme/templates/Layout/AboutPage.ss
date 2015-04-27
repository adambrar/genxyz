<% include Header %>
<div class="main" role="main">
    <div id="main-wrapper">
        <div class="container">
            <div id="content">
                <div class="content-container unit size3of4 lastUnit">
                    <article>
                        <div class="content row content-box-light">
                            <div class="10u -1u 12u(1) gutters-fix">
                                <div class="small-content-box">
                                    <h2><%t AboutPage.ABOUT "About" %></h2>
                                    $AboutStatement
                                </div>
                                <div class="small-content-box">
                                <h2><%t AboutPage.MISSION "Mission Statement" %></h2>
                                $MissionStatement
                                </div>

                                <div class="small-content-box">
                                <h2><%t AboutPage.VALUES "Values" %></h2>
                                $AboutValues
                                </div>
                            </div>
                        </div>

                    </article>
                </div>
            </div>
        </div>
    </div>
</div>
<% include Footer %>