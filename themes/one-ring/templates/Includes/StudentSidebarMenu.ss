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
</ul>