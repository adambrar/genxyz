<div class="row">
    <div class="col-sm-2">
        <div class="thumbnail">
        <img class="img-responsive img-rounded user-photo" src="$Author.ProfilePicture.Filename">
        </div><!-- /thumbnail -->
    </div><!-- /col-sm-1 -->

    <div class="col-sm-8">
        <div class="panel panel-default">
            <div class="panel-heading">
            <strong><a href="$Author.getProfilePageLink($Author.ID)">$AuthorName.XML</a></strong> <span class="text-muted">commented $Created.Nice ($Created.Ago)</span>
            </div><!-- /panel-heading -->
            <div class="panel-body">
            $EscapedComment
            </div><!-- /panel-body -->
        </div><!-- /panel panel-default -->
    </div><!-- /col-sm-5 -->
</div><!-- /row -->