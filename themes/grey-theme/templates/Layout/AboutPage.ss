<% include Header %>
<div class="main" role="main">
    <div id="main-wrapper">
        <div class="container">
            <div id="content">
                <div class="content-container unit size3of4 lastUnit">
                    <article>
                        <div class="content">
                            <h2><%t AboutPage.ABOUT "About" %></h2>
                            $AboutStatement

                            <h2><%t AboutPage.MISSION "Mission Statement" %></h2>
                            $MissionStatement

                            <h2><%t AboutPage.VALUES "Values" %></h2>
                            $AboutValues
                        </div>

                    </article>
                </div>
            </div>
        </div>
    </div>
</div>
<% include Footer %>