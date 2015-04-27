<tr>
	<td>
		<a class="topic-title" href="$Link">$Title</a>
	</td>
	<td class="">
		<% if LatestPost %>
			<% with LatestPost %>
                <p><% if $Link %><a href="$Link">$Title</a><% end_if %>
				<% with Author %>
					by <% if Link %><a href="$Link"><% if Nickname %>$Nickname<% else %>Anon<% end_if %></a><% else %><span>Anon</span><% end_if %></p>
				<% end_with %>
                <p>$Content.FirstParagraph(html).parse(BBCodeParser)</p>
                <p class="post-date">$Created.Ago</p>
			<% end_with %>
		<% end_if %>
	</td>
</tr>