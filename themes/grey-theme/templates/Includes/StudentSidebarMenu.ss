<ul>
    <% loop $Menu(1).Filter('menuStudentSidebar', 1) %>
        <% if $Children %>
            <li><a class="dropdown" href="">$MenuTitle.XML</a>
                <ul>
                    <% loop $Children %>
                        <li><a href="$Link" title="Go to the $Title.XML page" %>>$MenuTitle</a></li>
                    <% end_loop %>
                </ul>
        <% else %>
            <li><a href="$Link" title="$Title.XML">$MenuTitle.XML</a>
        <% end_if %>
        </li>
    <% end_loop %>
    </li>
    <li>-</li>
    <li><a class="dropdown" href="">Basic Information</a>
        <ul><li>$BasicProfileForm</li></ul>
    </li>
    <li><a class="dropdown" href="">Address</a>
        <ul><li>$AddressProfileForm</li></ul>
    </li>
    <li><a class="dropdown" href="">Education</a>
        <ul><li>$EducationProfileForm</li></ul>
    </li>
    <li><a class="dropdown" href="">Emergency Contact</a>
        <ul><li>$EmergencyContactProfileForm</li></ul>
    </li>
    <li><a class="dropdown" href="">Profile Picture</a>
        <ul><li>$ImageUpload</li></ul>
    </li>
</ul>

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