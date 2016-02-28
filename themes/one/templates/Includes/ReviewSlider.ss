<div class="row">
    <div class="col-sm-5 text-center">
        <textarea class="form-control margin-bottom" id="rating-textarea" placeholder="Add some text to your rating..." rows="4" maxlength="400"></textarea>
        <input type="hidden" class="rating rating-vote" value="3" data-filled="glyphicon glyphicon-star fa-2x" data-empty="glyphicon glyphicon-star-empty fa-2x" /></br>
        <input type="button" class="btn btn-small btn-primary rating-button" value="Rate!" data-school-link="$Link(rateschool)" data-school-id="{$Member.ID}"/>
        <p class="rating-response-text"></p>
    </div>
    <div class="col-sm-7">
        <div id="carousel-reviews" class="carousel slide reviews-slide" data-ride="carousel" data-interval="false">
            <div class="row">
                <div class="col-xs-offset-3 col-xs-6">
                    <div class="carousel-inner">
                        <% loop Top.Member.Ratings %>
                        <div class="item active">
                            <div class="carousel-content">
                                <div>
                                    <h3>$Rater.Name</h3>
                                    <a><input type="hidden" class="rating" value="{$Value}" data-filled="glyphicon glyphicon-star" data-empty="glyphicon glyphicon-star-empty" data-readonly /></a>
                                    <p>$Content</p>
                                    <p><a>$Created</a></p>
                                </div>
                            </div>
                        </div>
                        <% end_loop %>
                    </div>
                </div>
                <!-- Controls --> <a class="left carousel-control" href="#carousel-reviews" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left"></span>
                  </a>
                 <a class="right carousel-control" href="#carousel-reviews" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right"></span>
                  </a>
            </div>
            <!-- Controls --> <a class="left carousel-control" href="#carousel-reviews" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left"></span>
          </a>
         <a class="right carousel-control" href="#carousel-reviews" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right"></span>
          </a>

        </div>
    </div>
</div>