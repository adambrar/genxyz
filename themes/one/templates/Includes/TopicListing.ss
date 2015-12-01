<tr class="<% if IsSticky || IsGlobalSticky %>sticky<% end_if %> <% if IsGlobalSticky %>global-sticky<% end_if %>">
	<td class="topicName wow fadeInRight">
		<a class="topic-title" title="View this thread" href="$Link">$Title</a>
		<p class="topic-summary">
			<% _t('TopicListing_ss.BY','By') %>
			<% with FirstPost %>
				<% with Author %>
                    <a href="{$viewLink()}" title="<% _t('TopicListing_ss.CLICKTOUSER','Click here to view profile') %>">$FirstName $Surname</a>
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
			<p class="">$Created.Ago <a href="$Link" title="Go to this post"><i class="fa fa-eye"></i> View</a></p>
			<p class="">
				<% _t('TopicListing_ss.BY','by') %> 
                <% if Author %>
                    <% with Author %>
                        <a href="{$viewLink()}" title="<% _t('TopicListing_ss.CLICKTOUSER','Click here to view profile') %>">$FirstName $Surname</a>
                    <% end_with %>
                <% else %>
                    <a>Anonymous</a>
                <% end_if %>
			</p> 
		<% end_with %>
	</td>
</tr>