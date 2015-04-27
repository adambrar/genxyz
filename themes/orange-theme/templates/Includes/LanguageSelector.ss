<% if Translations %>
    <a id="lang-selector" href="">$Locale.Nice</a>
    <ul id="lang-dropdown">
        <% loop Translations %>
            <li>
                <a class="lang-option" href="$Link" hreflang="$Locale.RFC1766" title="$Title">Switch to $Locale.Nice</a>
            </li>
        <% end_loop %>
    </ul>    
<% end_if %>