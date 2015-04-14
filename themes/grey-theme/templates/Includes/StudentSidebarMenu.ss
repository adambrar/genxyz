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
    <li><a class="dropdown" href=""><%t StudentProfile.BASICINFORMATION "Basic Information" %></a>
        <ul><li>$BasicForm(Member)</li></ul>
    </li>
    <li><a class="dropdown" href=""><%t StudentProfile.ADDRESS "Address" %></a>
        <ul><li>$AddressForm</li></ul>
    </li>
    <li><a class="dropdown" href=""><%t StudentProfile.EDUCATION "Education" %></a>
        <ul><li>$EducationForm</li></ul>
    </li>
    <li><a class="dropdown" href=""><%t StudentProfile.EMERGENCYCONTACT "Emergency Contact" %></a>
        <ul><li>$EmergencyContactForm</li></ul>
    </li>
    <li><a class="dropdown" href=""><%t StudentProfile.PROFILEPICTURE "Profile Picture" %></a>
        <ul><li>$ImageUploadForm</li></ul>
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