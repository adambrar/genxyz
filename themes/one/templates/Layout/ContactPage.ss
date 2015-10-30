<% include EmptyHeader %>
<section id="get-in-touch">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title text-center wow fadeInDown">Get in Touch</h2>
            <p class="text-center wow fadeInDown">$Page(home).ContactMessage</p>
        </div>
        <div class="row">
                <div class="col-sm-4 col-sm-offset-4 wow fadeInUp">
                    <div class="contact-form">
                        <h3>Contact Info</h3>

                        <address>
                          <strong>$SiteConfig.Title</strong><br>
                          $SiteConfig.AddressLine1<br>
                          $SiteConfig.AddressLine2<br>
                          Phone: $SiteConfig.PhoneNumber
                        </address>
                        <strong>Or send us a message now:</strong>
                        <form id="main-contact-form" name="contact-form" method="post" action="#">
                            <div class="form-group">
                                <input type="text" name="name" class="form-control" placeholder="Name" required>
                            </div>
                            <div class="form-group">
                                <input type="email" name="email" class="form-control" placeholder="Email" required>
                            </div>
                            <div class="form-group">
                                <input type="text" name="subject" class="form-control" placeholder="Subject" required>
                            </div>
                            <div class="form-group">
                                <textarea name="message" class="form-control" rows="8" placeholder="Message" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Send Message</button>
                        </form>
                    </div>
                </div>
            </div>
    </div>
</section><!--/#get-in-touch-->