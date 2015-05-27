<% include ForumHeader %>

<table class="forum-topics">
	<tr class="category">
		<td class="page-numbers">
			<span><strong><% _t('Forum_show_ss.PAGE','Page:') %></strong></span>
			<% loop Posts.Pages %>
				<% if CurrentBool %>
					<span><strong>$PageNum</strong></span>
				<% else %>
					<a href="$Link">$PageNum</a>
				<% end_if %>
				<% if not Last %>,<% end_if %>
			<% end_loop %>
		</td>
		<td class="gotoButtonEnd" >
			<a class="scroll-link" href="#LastPost" title="<% _t('Forum_show_ss.CLICKGOTOEND','Click here to go the end of this post') %>"><% _t('Forum_show_ss.GOTOEND','Go to End') %></a>
		</td>
		<td class="replyButton">
			<% if ForumThread.canCreate %>
				<a href="$ReplyLink" title="<% _t('Forum_show_ss.CLICKREPLY','Click here to reply to this topic') %>"><% _t('Forum_show_ss.REPLY','Reply') %></a>
			<% end_if %>
			<% if CurrentMember %>
				<% include ForumThreadSubscribe %>
			<% end_if %>
		</td>
	</tr>
	<tr class="author">
		<td class="name">
			<span><% _t('Forum_show_ss.AUTHOR','Author') %></span>
		</td>
		<td class="topic">
			<span><strong><% _t('Forum_show_ss.TOPIC','Topic:') %></strong> $ForumThread.Title</span>
		</td>
		<td class="views">
			<span><strong>$ForumThread.NumViews <% _t('Forum_show_ss.VIEWS','Views') %></strong></span>
		</td>
	</tr>
</table>

<% loop Posts %>
    <% if $First %>
        <div id="FirstPost"><% include SinglePost %></div>
    <% else_if $Last %>
        <div id="LastPost"><% include SinglePost %></div>
    <% else %>
        <div><% include SinglePost %></div>
    <% end_if %>
<% end_loop %>

<table class="forum-topics">
	<tr class="author">
		<td class="author">&nbsp;</td>
		<td class="topic">&nbsp;</td>
		<td class="views">
			<span><strong>$ForumThread.NumViews <% _t('Forum_show_ss.VIEWS','Views') %></strong></span>
		</td>
	</tr>
	<tr class="category">
        <td>&nbsp;</td>		
		<td class="gotoButtonTop" >
			<a class="scroll-link" href="#FirstPost" title="<% _t('Forum_show_ss.CLICKGOTOTOP','Click here to go the top of this post') %>"><% _t('Forum_show_ss.GOTOTOP','Go to Top') %></a>
		</td>
		<td class="replyButton">
			<% if ForumThread.canCreate %>
				<a href="$ReplyLink" title="<% _t('Forum_show_ss.CLICKREPLY', 'Click to Reply') %>"><% _t('Forum_show_ss.REPLY', 'Reply') %></a>
			<% end_if %>
        </td>
	</tr>
</table>
            
<% if Posts.MoreThanOnePage %>
    <p class="forum-pages-numbers">
        <% if Posts.NotFirstPage %><a class="button small" href="$Posts.PrevLink"><i class="icon fa-angle-double-left pull-left"></i><% _t('Forum_show_ss.PREVLNK','Prev') %></a><% end_if %>
        <span>
        <% loop Posts.Pages %>
            <% if CurrentBool %>
                <strong>$PageNum</strong>
            <% else %>
                <a href="$Link">$PageNum</a>
            <% end_if %>
        <% end_loop %>
        </span>
        <% if Posts.NotLastPage %><a class="button small" href="$Posts.NextLink"><% _t('Forum_show_ss.NEXTLNK','Next') %><i class="icon fa-angle-double-right pull-right"></i></a><% end_if %>

    </p>
<% end_if %>

<% if AdminFormFeatures %>
<div class="forum-admin-features">
	<h3>Forum Admin Features</h3>
	$AdminFormFeatures
</div>
<% end_if %>

<% include ForumFooter %>