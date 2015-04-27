<div id="sidebar">

    <!-- Sidebar -->
    <section class="box feature">
        <div class="row">
            <a href="#" class="image fit"><img src="$ThemeDir/images/pic08.jpg" alt="" /></a>
            <div class="profile-heading">
                <ul>
                    <li><%t StudentProfile.NAME "Name" %>: $Member.FirstName $Member.Surname</li>
                    <% if $Member.HighSchool %>
                        <li><%t StudentProfile.HIGHSCHOOL "High School" %>: $HighSchoolName($Member.HighSchoolID)</li>
                    <% else %>
                        <li><%t StudentProfile.HIGHSCHOOLUNKNOWN "High School: Unknown" %></li>
                    <% end_if %>
                    <% if $Member.University %>
                        <li><%t StudentProfile.UNIVERSITY "University" %>: $UniversityName($Member.UniversityID)</li>
                    <% else %>
                        <li><%t StudentProfile.UNIVERSITYUNKNOWN "University: Unknown" %></li>
                    <% end_if %>
                    <li><%t StudentProfile.COUNTRY "Country" %>: $Member.Country</li>
                    <li><%t StudentProfile.BIRTHDAY "Birthday" %>: $Member.Birthday</li>
                </ul>
            </div>
        </div>
    </section>
</div>