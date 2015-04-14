<nav id="nav" class="primary">
    <ul>
        <% if $menuShown = "Welcome" %>
        
            <% if isSignedIn %>
                <li class="link"><a class="profile-button" href="{$profilePageLink}" title="MyProfile"><%t NavigationTemplate.MYPROFILE "MyProfile" %></a></li>
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
    
        <% else_if $menuShown = "Student" %>
            <li><a class="genxyz-button" href="home"><%t NavigationTemplate.GENXYZ "GenXYZ" %></a></li>

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
            
            <li><a class="logout-button" href="Security/logout"><%t NavigationTemplate.LOGOUT 'Logout' %></a></li>
        
        <% else_if $menuShown = "University" %>
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
        <% end_if %>
        <li><% include LanguageSelector %></li>
    </ul>
</nav>
