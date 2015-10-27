<% if EntriesByCategory.MoreThanOnePage %>
<div class="text-center">
	<ul class="pagination">
		<% if EntriesByCategory.NotFirstPage %>
			<li>
				<a href="$BlogEntries.PrevLink" title="View the previous page">«</a>
			</li>
		<% else %>	
			<li class="disabled">
				<a>«</a>
			</li>
		<% end_if %>
	
    	<% loop EntriesByCategory.PaginationSummary(4) %>
			<% if CurrentBool %>
				<li class="active"><a>$PageNum</a></li>
			<% else %>
				<% if Link %>
					<li>
						<a href="$Link">$PageNum</a>
					</li>
				<% else %>
					<li class="disabled"><a class="disabled">&hellip;</a></li>
				<% end_if %>
			<% end_if %>
		<% end_loop %>
	
		<% if EntriesByCategory.NotLastPage %>
			<li>
				<a href="$BlogEntries.NextLink" title="View the next page">»</a>
			</li>
		<% else %>
			<li class="disabled">
				<a>»</a>
			</li>
		<% end_if %>
	</ul>
</div>
<% end_if %>