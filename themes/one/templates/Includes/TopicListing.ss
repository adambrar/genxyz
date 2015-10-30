<tr class="<% if IsSticky || IsGlobalSticky %>sticky<% end_if %> <% if IsGlobalSticky %>global-sticky<% end_if %>">
	<td class="topicName wow fadeInRight">
		<a class="topic-title" href="$Link">$Title</a>
		<p class="topic-summary">
			<% _t('TopicListing_ss.BY','By') %>
			<% with FirstPost %>
				<% with Author %>
                    <a href="$getProfilePageLink($ID)" title="<% _t('TopicListing_ss.CLICKTOUSER','Click here to view profile') %>">$FirstName $Surname</a>
				<% end_with %>
				<% _t('TopicListing_ss.ON','on') %> $Created.Long
			<% end_with %>
		</p>
	</td>
	<td class="count wow fadeInRight" data-wow-delay="100ms">
		$NumPosts
	</td>
	<td class="last-post wow fadeInRight" data-wow-delay="300ms">
		<% with LatestPost %>
			<p class="">$Created.Ago</p>
			<p class="">
				<% _t('TopicListing_ss.BY','by') %> 
                <% if Author %>
                    <% with Author %>
                        <a href="$getProfilePageLink($ID)" title="<% _t('TopicListing_ss.CLICKTOUSER','Click here to view profile') %>">$FirstName $Surname</a>
                    <% end_with %>
                <% else %>
                    <a>Anonymous</a>
                <% end_if %>
				<a href="$Link" title="<% sprintf(_t('TopicListing_ss.GOTOFIRSTUNREAD','Go to the first unread post in the %s topic.'),$Title.XML) %>"><img src="forum/images/right.png" alt="" /></a>
			</p> 
		<% end_with %>
	</td>
</tr>