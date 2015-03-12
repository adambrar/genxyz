<div id="sidebar">

    <!-- Sidebar -->
    <section class="box feature">
        <div class="row">
            <div class="5u">
                <a href="#" class="image fit"><img src="$ThemeDir/images/pic01.jpg" alt="" /></a>
            </div>
            <div class="7u profile-heading">
                <ul>
                    <li>Name: $Member.FirstName $Member.Surname</li>
                    <li>High School: High School</li>
                    <li>University: University</li>
                    <li>Country: $Member.Country</li>
                    <li>Birthday: $Member.Birthday</li>
                </ul>
            </div>
        </div>
        
        <div class="user_menu">
            <% include StudentSidebarMenu %>
        </div>
    </section>
</div>