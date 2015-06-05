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
                                    <h2>$Title</h2>
                                    <p>$Message</p>
                                    <% loop $getScholarships %>
                                        <h1>$Name - $Amount</h1>
                                        <p><% if $Provider %>Offered By <strong>$Provider</strong><br/><% end_if %>
                                        <% if $DueDate %>Due in <strong>$DueDate.TimeDiffIn("days")</strong><br/><% end_if %>
                                            <a href="http://{$Website}">available here</a></p>
                                    <% end_loop %>
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