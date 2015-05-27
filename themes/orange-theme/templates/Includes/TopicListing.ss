<tr class="<% if IsSticky || IsGlobalSticky %>sticky<% end_if %> <% if IsGlobalSticky %>global-sticky<% end_if %>">
	<td class="topicName">
		<a class="topic-title" href="$Link">$Title</a>
		<p class="topic-summary">
			<% _t('TopicListing_ss.BY','By') %>
			<% with FirstPost %>
				<% with Author %>
					<a href="$getProfilePageLink($ID)" title="See this user's profile">$FirstName $Surname</a>
				<% end_with %>
				<% _t('TopicListing_ss.ON','on') %> $Created.Long
			<% end_with %>
		</p>
	</td>
	<td class="count">
		$NumPosts
	</td>
	<td class="last-post">
		<% with LatestPost %>
			<p class="">$Created.Ago
				<% _t('TopicListing_ss.BY','by') %> 
				<% with Author %>
					<a href="$getProfilePageLink($ID)" title="See this user's profile">$FirstName $Surname</a>
				<% end_with %> 
				<a href="$Link" title="<% sprintf(_t('TopicListing_ss.GOTOFIRSTUNREAD','Go to the first unread post in the %s topic.'),$Title.XML) %>"><img src="forum/images/right.png" alt="" /></a>
			</p> 
		<% end_with %>
	</td>
</tr>