<footer id="footer">
        <div class="container">
            <div class="row margin-bottom">
                <div class="col-sm-3">
                    PAGES
                    <ul>
                        <li><a href="contact">Contact Us</a></li>
                        <li><a href="about">About Us</a></li>
                        <li><a href="services">Our Services</a></li>
                        <li><a href="our-initiatives">Our Initiatives</a></li>
                        <% if NotTrue %><li><a href="genxyz">Blog Posts</a></li><% end_if %>
                        <li><a href="forums">Forums</a></li>
                        <li><a href="terms-and-conditions">Terms and Conditions</a></li>
                    </ul>
                    PARTNERS
                    <ul>
                        <li><a href="school">Schools</a></li>
                        <li><a href="agent">Agents</a></li>
                    </ul>
                </div>
                <div class="col-sm-3">
                    SCHOLARSHIPS
                    $SiteConfig.Scholarships
                </div>
                <div class="col-sm-3">
                    HIGHLIGHT OF THE MONTH<br>
                    $SiteConfig.HighlightofMonth
                </div>
                <div class="col-sm-3">
                    SPECIAL THANKS TO<br>
                    $SiteConfig.SpecialThanks
                </div>
            </div>
            <div class="row margin-top">
                <div class="col-sm-6">
                    Designed by <a target="_blank" href="http://adambrar.com/" title="Web Developemnt">Adam Brar</a>
                </div>
                <div class="col-sm-6">
                    <ul class="social-icons">
                        <li><a href="$SiteConfig.FacebookLink"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="$SiteConfig.TwitterLink"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="$SiteConfig.SnapchatLink"><i class="fa fa-google-plus"></i></a></li>
                        <li><a href="$SiteConfig.InstagramLink"><i class="fa fa-pinterest"></i></a></li>
                        <li><a href="$SiteCongif.YoutubeLink"><i class="fa fa-youtube"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer><!--/#footer-->
    <!-- Piwik -->
    <script type="text/javascript">
      var _paq = _paq || [];
      _paq.push(['trackPageView']);
      _paq.push(['enableLinkTracking']);
      (function() {
        var u="//localhost/piwik/piwik/";
        _paq.push(['setTrackerUrl', u+'piwik.php']);
        _paq.push(['setSiteId', 1]);
        var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
        g.type='text/javascript'; g.async=true; g.defer=true; g.src=u+'piwik.js'; s.parentNode.insertBefore(g,s);
      })();
    </script>
    <noscript><p><img src="//localhost/piwik/piwik/piwik.php?idsite=1" style="border:0;" alt="" /></p></noscript>
    <!-- End Piwik Code -->
<!-- === END FOOTER === -->