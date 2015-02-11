<% include Header %>
<div class="main" role="main">
	<div class="inner typography line">
        <div id="main-wrapper">
            <div class="container">
                <div class="row 200%">
                    <div class="5u">
                        <a href="#" class="image fit"><img src="/manis/images/pic08.jpg" alt="" /></a>
                        <hr>
                        <div class="profile-heading">
                            <ul>
                                <li>Student Name</li>
                                <li>High School Name</li>
                                <li>University Name</li>
                                <li>Major</li>
                                <li>Nationality</li>
                                <li>Birthday</li>
                            </ul>
                        </div>
                    </div>
                    <div class="7u">
                        <div id="content">
                            <div class="content-container unit size3of4 lastUnit">
                                <article>
                                    <div class="content">$Content</div>
                                </article>
                                    $Form
                                    $PageComments
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
	</div>
</div>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
<script>
$(function() {	
    $("a.dropdown").click(function() {
        var ul = $(this).next(),
                clone = ul.clone().css({"height":"auto"}).appendTo("body"),
                height = ul.css("height") === "0px" ? ul[0].scrollHeight + "px" : "0px";

        clone.remove();
        ul.animate({"height":height});
        return false;
    });

});
</script>
<% include Footer %>
