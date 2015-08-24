<tr>
	<td>
		<a class="topic-title" href="$Link">$Title</a>
		<% if Content || Moderators %>
			<div class="summary">
				<p>$Content.LimitCharacters(80)</p>
			</div>
		<% end_if %>
	</td>
	<td class="">
		<% if LatestPost %>
			<% with LatestPost %>
                <a href={$Link}>$Content.LimitCharacters(30)</a>
				<% with Author %>
					<p>by <a href="$getProfilePageLink($ID)">$FirstName $Surname</a></p>
				<% end_with %>
				<p class="post-date">$Created.Ago</p>
			<% end_with %>
		<% end_if %>
	</td>
</tr>