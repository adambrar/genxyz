<div class="row 50%">
    <div class="2u profile-picture">
        <a href="$Author.getProfilePageLink($Author.ID)" class="image fit"><img class="avatar" src="$Author.getProfilePictureLink($Author.ID)" alt="Avatar" /></a>
    </div>
    <div class="10u">
        <div class="comment-content" id="$Permalink">
            $EscapedComment
        </div>

        <h1 class="info">
            <% _t('CommentsInterface_singlecomment_ss.PBY','Posted by') %> <a href="$Author.getProfilePageLink($Author.ID)">$AuthorName.XML</a>, $Created.Nice ($Created.Ago)
        </h1>

        <% if $ApproveLink || $SpamLink || $HamLink || $DeleteLink %>
            <ul class="action-links">
                <% if ApproveLink %>
                    <li><a href="$ApproveLink.ATT" class="approve"><% _t('CommentsInterface_singlecomment_ss.APPROVE', 'approve this comment') %></a></li>
                <% end_if %>
                <% if SpamLink %>
                    <li><a href="$SpamLink.ATT" class="spam"><% _t('CommentsInterface_singlecomment_ss.ISSPAM','this comment is spam') %></a></li>
                <% end_if %>
                <% if HamLink %>
                    <li><a href="$HamLink.ATT" class="ham"><% _t('CommentsInterface_singlecomment_ss.ISNTSPAM','this comment is not spam') %></a></li>
                <% end_if %>
                <% if DeleteLink %>
                    <li class="last"><a href="$DeleteLink.ATT" class="delete"><% _t('CommentsInterface_singlecomment_ss.REMCOM','remove this comment') %></a></li>
                <% end_if %>
            </ul>
        <% end_if %>
    </div>
</div>