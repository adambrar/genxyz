<div id="post{$ID}" class="forum-post">
	<div class="user-info wow fadeInLeft">
        <% if Author %>
            <% with Author %>
                <a class="author-link" href="{$viewLink()}" title="<% _t('SinglePost_ss.GOTOPROFILE','Go to this profile') %>">$FirstName $Surname</a><br />

                <a href="{$viewLink()}" title="Go to this profile"><img class="avatar" style="width:100%;" src="<% if ProfilePicture %>{$ProfilePicture.Filename()}<% else %>$SiteConfig.DefaultProfilePicture.Filename()<% end_if %>" alt="Avatar" /></a><br />
                <% if ForumRank %><span class="forum-rank">$ForumRank</span><br /><% end_if %>
                <% if NumPosts %>
                    <span class="post-count">$NumPosts 
                    <% if NumPosts = 1 %>
                        <% _t('SinglePost_ss.POST', 'Post') %>
                    <% else %>
                        <% _t('SinglePost_ss.POSTS', 'Posts') %>
                    <% end_if %>
                    </span>
                <% end_if %>
            <% end_with %>
        <% else %>
            <a class="author-link">Anonymous</a><br />
            <img class="avatar" style="width:100%;" src="$SiteConfig.DefaultProfilePicture.Filename()" alt="Avatar" /><br />
        <% end_if %>
	</div><!-- user-info. -->

	<div class="user-content wow fadeInRight">

		<div class="quick-reply">
			<% if Thread.canPost %>
				<p>$Top.ReplyLink</p>
			<% end_if %>
		</div>
		<h4><a class="tohash" href="$Link">$Title</a></h4>
		<p class="post-date">$Created.Long at $Created.Time
		<% if Updated %>
			<strong><% _t('SinglePost_ss.LASTEDITED','Last edited:') %> $Updated.Long <% _t('SinglePost_ss.AT') %> $Updated.Time</strong>
		<% end_if %></p>
		
		<% if EditLink || DeleteLink %>
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
		<div class="post-type">
			$Content.Parse(BBCodeParser)
		</div>
		
		<% if Thread.DisplaySignatures %>
			<% with Author %>
				<% if Signature %>
					<div class="signature">
						<p>$Signature</p>
					</div>
				<% end_if %>
			<% end_with %>
		<% end_if %>

		<% if Attachments %>
			<div class="attachments">
				<strong><% _t('SinglePost_ss.ATTACHED','Attached Files') %></strong> 
				<ul class="post-attachments">
				<% loop Attachments %>
					<li>
						<a href="$Link"><img src="$Icon"></a>
						<a href="$Link">$Name</a><br />
						<% if ClassName = "Image" %>$Width x $Height - <% end_if %>$Size
					</li>
				<% end_loop %>
				</ul>
			</div>
		<% end_if %>
	</div>
	<div class="clear"><!-- --></div>
</div><!-- forum-post. -->
