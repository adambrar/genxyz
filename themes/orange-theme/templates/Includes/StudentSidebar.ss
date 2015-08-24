<div id="sidebar">

    <!-- Sidebar -->
    <section>
        <div class="row">
            <div class="6u">
                <a href="#" class="image fit"><img class="profile-picture" src="{$Member.ProfilePictureLink($Member.ProfilePictureID)}" alt="Avatar" /></a>
                <h1 class="picture-overlay"><span><a class="profile-picture-edit" href="#">Change</a></span></h1>
            </div>
            <div class="6u profile-heading">
                <ul>
                    <li><h1>$Member.FirstName.LimitCharacters(12, "...") $Member.Surname.LimitCharacters(12, "...")</h1></li>
                </ul>
            </div>
        </div>
        <div class="row user_menu">

            <% include StudentSidebarMenu %>
        </div>
    </section>
</div>