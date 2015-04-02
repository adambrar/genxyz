<div id="sidebar">

    <!-- Sidebar -->
    <section class="box feature">
        <div class="row">
            <a href="#" class="image fit"><img src="$ThemeDir/images/pic08.jpg" alt="" /></a>
            <div class="profile-heading">
                <ul>
                    <li>Name: $Member.FirstName $Member.Surname</li>
                    <% if $Member.HighSchool %>
                        <li>High School: $Member.HighSchoolID</li>
                    <% else %>
                        <li>High School: Unknown</li>
                    <% end_if %>
                    <% if $Member.University %>
                        <li>University: $Member.UniversityID</li>
                    <% else %>
                        <li>University: Undecided</li>
                    <% end_if %>
                    <li>Country: $Member.Country</li>
                    <li>Birthday: $Member.Birthday</li>
                </ul>
            </div>
        </div>
    </section>
</div>