<div id="sidebar">

    <!-- Sidebar -->
    <section class="box feature">
        <div class="row">
            <a href="#" class="image fit"><img src="$ThemeDir/images/pic08.jpg" alt="" /></a>
            <div class="profile-heading">
                <h2>
                <ul id="student-view-info-box">
                    <li><%t StudentProfile.NAME "Name" %>: <span class="student-sidebar-text">$Member.FirstName $Member.Surname</span></li>
                    <% if $Member.HighSchool %>
                        <li><%t StudentProfile.HIGHSCHOOL "High School" %>: <span class="student-sidebar-text">$HighSchoolName($Member.HighSchoolID)</span></li>
                    <% else %>
                        <li><%t StudentProfile.HIGHSCHOOLUNKNOWN "High School: <span class='student-sidebar-text'>Unknown</span>" %></li>
                    <% end_if %>
                    <% if $Member.University %>
                        <li><%t StudentProfile.UNIVERSITY "University" %>: <span class="student-sidebar-text">$UniversityName($Member.UniversityID)</span></li>
                    <% else %>
                        <li><%t StudentProfile.UNIVERSITYUNKNOWN "University: <span class='student-sidebar-text'>Unknown</span>" %></li>
                    <% end_if %>
                    <li><%t StudentProfile.COUNTRY "Country" %>: <span class="student-sidebar-text">$CountryName($Member.Country)</span></li>
                    <li><%t StudentProfile.BIRTHDAY "Birthday" %>: <span class="student-sidebar-text">$Member.Birthday</span></li>
                </ul>
                </h2>
            </div>
        </div>
    </section>
</div>