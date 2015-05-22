<div id="sidebar">

    <!-- Sidebar -->
    <section class="box feature">
        <div class="row">
            <div class="6u">
                <a href="#" class="image fit"><img src="/Silverstripe/{$ProfilePicture}" alt="ProfilePicture" /></a>
            </div>
            <div class="6u profile-heading">
                <ul>
                    <li><h2>$Member.FirstName.LimitCharacters(12, "...") $Member.Surname.LimitCharacters(12, "...")</h2></li>
                </ul>
            </div>
        </div>
        <div class="row user_menu">

            <% include StudentSidebarMenu %>
        </div>
    </section>
</div>