<% if Translations %>
    <a id="lang-selector" href="">$Locale.Nice</a>
    <ul>
        <% loop Translations %>
            <li>
                <a class="lang-option" href="$Link" hreflang="$Locale.RFC1766" title="$Title">
                    Switch to $Locale.Nice
                </a><span class="flag-icon flag-icon-gr"></span>
            </li>
        <% end_loop %>
    </ul>    
<% end_if %>