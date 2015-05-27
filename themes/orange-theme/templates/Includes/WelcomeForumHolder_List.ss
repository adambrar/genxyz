<tr>
	<td>
		<a class="topic-title" href="$Link"><h1 class="link-title">$Title</h1></a>
	</td>
	<td class="">
		<% if LatestPost %>
			<% with LatestPost %>
                <p><% if $Link %><a href="$Link">$Title</a><% end_if %>
				<% with Author %>
					by <a href="$getProfilePageLink($ID)" title="See this user's profile">$FirstName $Surname</a></p>
				<% end_with %>
                <p>$Content.LimitCharacters(120)</p>
                <p class="post-date">$Created.Ago</p>
			<% end_with %>
		<% end_if %>
	</td>
</tr>