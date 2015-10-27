<div class="row">
    <h1>$Title</h1>
    <p>$Message</p>
    <div class="list-group">
        <% loop AllScholarships %>
            <a href="$Website" class="list-group=item">
                <h4 class="list-group-item-heading">$Name - $Amount</h4>
                <p class="list-group-item-text">...</p>
            </a>
        <% end_loop %>
    </div>
</div>
 