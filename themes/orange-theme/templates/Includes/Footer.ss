<footer class="footer" role="contentinfo">
	<div id="footer-wrapper">
				<footer id="footer" class="container">
                    <div class="row">
                        <div class="3u 12u(7)">
                            <section class="widget links"><h3>Scholarships</h3>
                                <ul>
                                    <% loop getFooterScholarships %>
                                        <li><a href="http://{$Website}">$Name</a> - $Amount</li>
                                    <% end_loop %>
                                </ul>
                            </section>
                        </div>
                        <div class="3u 12u(8)">
                            <section class="widget links"><h3>Highlight of the Month</h3>
                                    $SiteConfig.HighlightofMonth
                            </section>
                        </div>
                        <div class="3u 12u(9)">
                            <section class="widget links"><h3>Special Thanks To</h3>
                                    $SiteConfig.SpecialThanks
                            </section>
                        </div>
                        <div class="3u 12u(10)">
                            <section class="widget contact last"><h3>Contact Us</h3>
                                <ul>
                                    <li><a class="icon fa-twitter" href="http://{$SiteConfig.TwitterLink}" target="_blank"><span class="label">Twitter</span></a></li>
                                    <li><a class="icon fa-facebook" href="http://{$SiteConfig.FacebookLink}" target="_blank"><span class="label">Facebook</span></a></li>
                                    <li><a class="icon fa-instagram" href="http://{$SiteConfig.InstagramLink}" target="_blank"><span class="label">Instagram</span></a></li>
                                </ul>
                                $SiteConfig.Address
                            </section>
                        </div>
                    </div>
                    <div class="row">
                        <div class="12u">
                            <div id="copyright">
                                <ul class="menu"><li>©2015 GenXYZ. All rights reserved.</li>
                                </ul>
                            </div>
                        </div>
                    </div>
				</footer>
			</div>
</footer>