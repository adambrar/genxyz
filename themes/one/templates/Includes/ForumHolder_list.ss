<tr>
	<td class="wow fadeInRight">
		<a class="topic-title" href="$Link">$Title</a>
		<% if Content || Moderators %>
			<div class="summary">
				<p>$Content.LimitCharacters(80)</p>
			<% if Moderators %>
				<p>Moderators: <% loop Moderators %>
				<a href="$Link">$Nickname</a>
				<% if not Last %>, <% end_if %><% end_loop %></p>
			<% end_if %>
			</div>
		<% end_if %>
	</td>
	<td class="count wow fadeInRight" data-wow-delay="100ms">
		$NumTopics
	</td>
	<td class="count wow fadeInRight" data-wow-delay="300ms">
		$NumPosts
	</td>
	<td class="wow fadeInRight" data-wow-delay="500ms">
		<% if LatestPost %>
			<% with LatestPost %>
                <a class="topic-title" href="$Link" title="View post">$Title</a><br >
				<% with Author %>
					by <a href="$getProfilePageLink($ID)">$FirstName $Surname</a>
				<% end_with %>
				<span class="post-date">$Created.Ago</span>
			<% end_with %>
		<% end_if %>
	</td>
</tr>