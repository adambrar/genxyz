<nav id="nav" class="primary">
    
    <% if $menuShown = "Welcome" %>
        <ul>
            <% if isSignedIn %>
                <li class="link"><a href="/myprofile" title="MyProfile">MyProfile</a></li>
            <% end_if %>
            <% loop $Menu(1).Filter('menuWelcome', 1) %>
                <% if $Children %>
                    <% if $showDropdown %>
                        <li class="$LinkingMode"><a href="" title="$Title.XML">$MenuTitle.XML</a>
                        <ul>
                        <% loop $Children %>
                            <li><a href="$Link" title="Go to the $Title.XML page" <% if LinkingMode %>class="$LinkingMode"<% end_if %>>$MenuTitle</a>
                                <% if $Children %>
                                   <ul>
                                      <% loop $Children %>
                                           <li><a href="$Link" title="Go to the $Title.XML page" <% if LinkingMode %>class="$LinkingMode"<% end_if %>>$MenuTitle</a></li>
                                      <% end_loop %>
                                  </ul>
                                <% end_if %>
                            </li>
                          <% end_loop %>
                        </ul>
                    <% else %>
                        <li class="$LinkingMode"><a href="$Link" title="$Title.XML">$MenuTitle.XML</a>
                    <% end_if %>
                <% else %>
                    <li class="$LinkingMode"><a href="$Link" title="$Title.XML">$MenuTitle.XML</a>
                <% end_if %>            
                </li>
            <% end_loop %>
        </ul>
    
    <% else_if $menuShown = "Student" %>
        <ul>   
            <% loop $Menu(1).Filter('menuStudent', 1) %>
                <% if $Children %>
                    <% if $showDropdown %>
                        <li class="$LinkingMode"><a href="" title="$Title.XML">$MenuTitle.XML</a>
                        <ul>
                        <% loop $Children %>
                            <li><a href="$Link" title="Go to the $Title.XML page" <% if LinkingMode %>class="$LinkingMode"<% end_if %>>$MenuTitle</a>
                                <% if $Children %>
                                   <ul>
                                      <% loop $Children %>
                                           <li><a href="$Link" title="Go to the $Title.XML page" <% if LinkingMode %>class="$LinkingMode"<% end_if %>>$MenuTitle</a></li>
                                      <% end_loop %>
                                  </ul>
                                <% end_if %>
                            </li>
                          <% end_loop %>
                        </ul>
                    <% else %>
                        <li class="$LinkingMode"><a href="$Link" title="$Title.XML">$MenuTitle.XML</a>
                    <% end_if %>
                <% else %>
                    <li class="$LinkingMode"><a href="$Link" title="$Title.XML">$MenuTitle.XML</a>
                <% end_if %>            
                </li>
            <% end_loop %>
            <li><a class="" href="home">GenXYZ</a></li>
            <li><a class="" href="Security/logout">Logout</a></li>
        </ul>
        
    <% else_if $menuShown = "University" %>
        <ul>   
            <% loop $Menu(1).Filter('menuUniversity', 1) %>
                <% if $Children %>
                    <% if $showDropdown %>
                        <li class="$LinkingMode"><a href="" title="$Title.XML">$MenuTitle.XML</a>
                        <ul>
                        <% loop $Children %>
                            <li><a href="$Link" title="Go to the $Title.XML page" <% if LinkingMode %>class="$LinkingMode"<% end_if %>>$MenuTitle</a>
                                <% if $Children %>
                                   <ul>
                                      <% loop $Children %>
                                           <li><a href="$Link" title="Go to the $Title.XML page" <% if LinkingMode %>class="$LinkingMode"<% end_if %>>$MenuTitle</a></li>
                                      <% end_loop %>
                                  </ul>
                                <% end_if %>
                            </li>
                          <% end_loop %>
                        </ul>
                    <% else %>
                        <li class="$LinkingMode"><a href="$Link" title="$Title.XML">$MenuTitle.XML</a>
                    <% end_if %>
                <% else %>
                    <li class="$LinkingMode"><a href="$Link" title="$Title.XML">$MenuTitle.XML</a>
                <% end_if %>            
                </li>
            <% end_loop %>
        </ul>
    <% end_if %>
</nav>
