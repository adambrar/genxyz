<div id="post{$ID}" class="row forum-post">
	<div class="col-sm-4 wow fadeInLeft">
        <% if Author %>
            <% with Author %>
                <a class="text-center" href="{$viewLink()}" title="<% _t('SinglePost_ss.GOTOPROFILE','Go to this profile') %>"><strong>$FirstName $Surname</strong></a>

                <a href="{$viewLink()}" title="Go to this profile"><img class="avatar" style="width:100%;" src="<% if ProfilePicture %>{$ProfilePicture.Filename()}<% else %>$SiteConfig.DefaultProfilePicture.Filename()<% end_if %>" alt="Avatar" /></a>
            <% end_with %>
        <% else %>
            <a class="author-link">Anonymous</a><br />
            <img class="avatar" style="width:100%;" src="$SiteConfig.DefaultProfilePicture.Filename()" alt="Avatar" /><br />
        <% end_if %>
	</div><!-- user-info. -->

	<div class="col-sm-8 wow fadeInRight">
		<h4><a class="tohash" href="$Link">$Title</a></h4>
		<p class="post-date">$Created.Long at $Created.Time
		<% if Updated %>
			<strong><% _t('SinglePost_ss.LASTEDITED','Last edited:') %> $Updated.Long <% _t('SinglePost_ss.AT') %> $Updated.Time</strong>
		<% end_if %></p>
		
		<div class="post-type">
			$Content.LimitCharacters(250).Parse(BBCodeParser)
		</div>
		<div class="quick-reply">
			<% if Thread.canPost %>
				<a href="{$Link('reply')}" class="btn btn-primary btn-sm">Post Reply!</a>
			<% end_if %>
		</div>
        <% if EditLink || DeleteLink || MarkAsSpamLink || BanLink || GhostLink %>
			<div class="post-modifiers">
				<% if EditLink %>
					$EditLink
				<% end_if %>
				
				<% if DeleteLink %>
					$DeleteLink
				<% end_if %>
				
				<% if MarkAsSpamLink %>
					$MarkAsSpamLink
				<% end_if %>

				<% if BanLink || GhostLink %>
					|
					<% if BanLink %>$BanLink<% end_if %>
					<% if GhostLink %>$GhostLink<% end_if %>
				<% end_if %>

			</div>
		<% end_if %>
	</div>
	<div class="clear"><!-- --></div>
</div><!-- forum-post. -->

