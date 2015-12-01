<% with ForumHolder %>
	<div class="forum-footer">
		<p>
			<strong><% _t('ForumFooter_ss.LATESTMEMBER','Welcome to our latest member:') %></strong>			
			<% if $NewestMembers(4) %>
				<% loop $NewestMember(4) %>
					<a href="{$viewLink()}" title="Profile page for $FirstName $Surname">$FirstName $Surname</a><% if Last %><% else %> | <% end_if %> 
				<% end_loop %>
			<% end_if %>
		</p>
	</div><!-- forum-footer. -->
<% end_with %>
