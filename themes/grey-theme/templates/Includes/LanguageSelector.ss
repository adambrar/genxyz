<% if Translations %>
    <div id="lang">
        <ul>
            <% loop Translations %>
                <li>
                    <a href="$Link" hreflang="$Locale.RFC1766" title="$Title">
                        Show page in $Locale.Nice
                   </a>
                </li>
            <% end_loop %>
        </ul>    
    </div>   
<% end_if %>


<%-- if Translations %>
    <div id="lang">
        <select onChange="window.location.href=this.value">
            <option value="">Select a Language</option>
            <% loop Translations %>
                <option value="$Link">$Locale.Nice</option>
            <% end_loop %>
        </select>    
    </div>   
<% end_if --%>