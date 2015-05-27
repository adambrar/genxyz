                <% with ForumHolder %>
                    <div class="forum-footer">
                        <!--<% if $CurrentlyOnlineEnabled %>
                        <p>
                            <strong><% _t('ForumFooter_ss.CURRENTLYON','Currently Online:') %></strong>
                            <% if $CurrentlyOnline %>
                                <% loop CurrentlyOnline %>
                                    <% if Link %><a href="$Link" title="<% if Nickname %>$Nickname<% else %>Anon<% end_if %><% _t('ISONLINE',' is online') %>"><% if Nickname %>$Nickname<% else %>Anon<% end_if %></a><% else %><span>Anon</span><% end_if %><% if Last %><% else %>,<% end_if %>
                                <% end_loop %>
                            <% else %>
                                <span><% _t('ForumFooter_ss.NOONLINE','There is nobody online.') %></span>
                            <% end_if %>
                        </p>
                        <% end_if %> -->
                        <p>
                            <strong><% _t('ForumFooter_ss.LATESTMEMBER','Welcome to our latest member:') %></strong>			
                            <% if $NewestMember(1) %>
                                <% loop $NewestMember(1) %>
                                    <a href="$getProfilePageLink($ID)">$FirstName $Surname</a>
                                <% end_loop %>
                            <% end_if %>
                        </p>
                    </div><!-- forum-footer. -->
                <% end_with %>
                </div>
            </div>
            </div>
        </div>
        </div>
   </div>
</div>
<% include Footer %>
    
</body>
</html>
