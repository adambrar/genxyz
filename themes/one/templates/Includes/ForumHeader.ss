<div class="forum-header row">
    <div class="col-md-3">
	<% loop ForumHolder %>
        <div class="forum-header-form">
            <h4><a class="Header">Select a topic</a></h4>
            <form class="forum-jump" action="#">
                <label for="forum-jump-select"><% _t('ForumHeader_ss.JUMPTO','Jump to:') %></label>
                <select id="forum-jump-select" onchange="if(this.value) location.href = this.value">
                    <option value=""><% _t('ForumHeader_ss.JUMPTO','Jump to:') %></option>
                    <!-- option value=""><% _t('ForumHeader_ss.SELECT','Select') %></option -->
                    <% if ShowInCategories %>
                        <% loop Forums %>
                            <optgroup label="$Title">
                                <% loop CategoryForums %>
                                    <% if can(view) %>
                                        <option value="$Link">$Title</option>
                                    <% end_if %>
                                <% end_loop %>
                            </optgroup>
                        <% end_loop %>
                    <% else %>
                        <% loop Forums %>
                            <% if can(view) %>
                                <option value="$Link">$Title</option>
                            <% end_if %>
                        <% end_loop %>
                    <% end_if %>
                </select>
            </form>

            <% if NumPosts %>
                <p class="forumStats">
                    $NumPosts 
                    <strong><% _t('ForumHeader_ss.POSTS','Posts') %></strong> 
                    <% _t('ForumHeader_ss.IN','in') %> $NumTopics <strong><% _t('ForumHeader_ss.TOPICS','Topics') %></strong> 
                    <% _t('ForumHeader_ss.BY','by') %> $NumAuthors <strong><% _t('ForumHeader_ss.MEMBERS','members') %></strong>
                </p>
            <% end_if %>
        </div>
	<% end_loop %>
    </div>
    <div class="col-md-6">

        <h1 class="forum-heading"><a name='Header'>$HolderSubtitle</a></h1>
        <p class="forum-abstract">$ForumHolder.HolderAbstract</p>

        <% if Moderators %>
            <p>
                Moderators: 
                <% loop Moderators %>
                    <a href="$getProfilePageLink($ID)">$FirstName $Surname</a>
                    <% if not Last %>, <% end_if %>
                <% end_loop %>
            </p>
        <% end_if %>
    </div>
    <div class="col-md-3">
        <span class="forum-search-dropdown-icon"></span>
        <div class="forum-search-bar forum-header-form">
            <h4><a class="Header">Search forum</a></h4>
            <form class="forum-search" action="$Link(search)" method="get">
                <fieldset>
                    <label for="search-text"><% _t('ForumHeader_ss.SEARCHBUTTON','Search') %></label>
                    <input id="search-text" class="text active" type="text" name="Search" value="$Query.ATT" />
                    <input class="submit action" type="submit" value="<% _t('ForumHeader_ss.SEARCHBUTTON','Search') %>"/>
                </fieldset>	
            </form>
        </div>
    </div>
    

</div><!-- forum-header. -->
<p class="forum-breadcrumbs">$Breadcrumbs</p>

