<% include EmptyHeader %>
<div class="row margin-bottom">
    <div class="col-md-6 col-md-offset-3 wow fadeInLeft">
        <h1>$Title</h1>
        <form action="charge.php" method="post">
          <script src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                  data-key="pk_test_ou3rXR9aUIFdtShDbyFDvtig"
                  data-description="School Application"
                  data-name="GenXYZ"
                  data-amount="5000"
                  data-currency="CAD"
                  data-locale="auto"
                  data-email="user@email.com"
                  data-billing-address="false"></script>
        </form>
        $Form
    </div>
</div>