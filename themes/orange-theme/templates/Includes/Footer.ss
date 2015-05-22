<footer class="footer" role="contentinfo">
	<div id="footer-wrapper">
				<footer id="footer" class="container">
					<% with $SiteConfig %>
                        <div class="row">
                            <div class="3u 12u(7)">
                                <section class="widget links"><h3>Scholarships</h3>
                                        $Scholarships
                                </section>
                            </div>
                            <div class="3u 12u(8)">
                                <section class="widget links"><h3>Highlight of the Month</h3>
                                        $HighlightofMonth
                                </section>
                            </div>
                            <div class="3u 12u(9)">
                                <section class="widget links"><h3>Special Thanks To</h3>
                                        $SpecialThanks
                                </section>
                            </div>
                            <div class="3u 12u(10)">
                                <section class="widget contact last"><h3>Contact Us</h3>
                                    <ul>
                                        <li><a class="icon fa-twitter" href="#"><span class="label">Twitter</span></a></li>
                                        <li><a class="icon fa-facebook" href="#"><span class="label">Facebook</span></a></li>
                                        <li><a class="icon fa-instagram" href="#"><span class="label">Instagram</span></a></li>
                                        <li><a class="icon fa-dribbble" href="#"><span class="label">Dribbble</span></a></li>
                                        <li><a class="icon fa-pinterest" href="#"><span class="label">Pinterest</span></a></li>
                                    </ul>
                                    $Address
                                </section>
                            </div>
                        </div>
                        <div class="row">
                            <div class="12u">
                                <div id="copyright">
                                    <ul class="menu"><li>© Untitled. All rights reserved.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    <% end_with %>
				</footer>
			</div>
</footer>