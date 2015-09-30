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
    <li></li>
    <% if $Top.isProfileSaved %>
        <li><span class="message good">Your profile has been updated!</span></li>
    <% end_if %>
    <li id="account-settings-menu">
        <a id="account-settings" class="dropdown" href=""><%t StudentProfile.ACCOUNTSETTINGS "Account Settings" %></a>
        <ul>
            <li>
                <a class="form-dropdown" href=""><%t StudentProfilePage.BASICINFORMATION "Basic Information" %></a>
                <ul><li>$getProfileForm("Basic")</li></ul> 
                        
            </li>
            <li>
                <a class="form-dropdown" href=""><%t StudentProfilePage.ADDRESS "Address" %></a>
                <ul><li>$getProfileForm("Address")</li></ul> 
                        
            </li>
            <li>
                <a class="form-dropdown" href=""><%t StudentProfilePage.EDUCATION "Education" %></a>
                <ul><li>$getProfileForm("Education")</li></ul> 
                        
            </li>
            <li>
                <a class="form-dropdown" href=""><%t StudentProfilePage.EMERGENCYCONTACT "Emergency Contact" %></a>
                <ul><li>$getProfileForm("Contact")</li></ul> 
                        
            </li>
            <li>
                <a class="form-dropdown profile-picture-form" href=""><%t StudentProfilePage.PROFILEPICTURE "Profile Picture" %></a>
                <ul><li>$getProfileForm("ProfilePicture")</li></ul> 
                        
            </li>
        </ul>       
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
    
    $("a.form-dropdown").click(function() {
        
        var ul = $(this).next(),
                clone = ul.clone().css({"height":"auto"}).appendTo("body"),
                height = ul.css("height") === "0px" ? ul[0].scrollHeight + "px" : "0px";
        
        var sum = 40 + parseInt(height);
        $('.form-dropdown').each(function() {
            sum += $(this).height();
        });
        
        $(this).parent().siblings().each(function() {
            $(this).children("ul").animate({"height":"0px"});
        });

        $(this).parent().parent().animate({"height":sum});

        clone.remove();
        ul.animate({"height":height});
        
        return false;
    });
    
    
});
</script>