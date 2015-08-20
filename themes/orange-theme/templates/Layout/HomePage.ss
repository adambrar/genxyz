<% include Header %>
<div id="main-wrapper" class="main" role="main">
    <article class="home_page">
        <div id="slideshow">
            <div class="container 125%">
                <ul class="slides">
                    <li><img src="assets/homepage/slides/1.jpg" alt="Blue World" /></li>
                    <li><img src="assets/homepage/slides/2.jpg" alt="Eagle" /></li>
                    <li><img src="assets/homepage/slides/3.jpg" alt="Building" /></li>
                    <li><img src="assets/homepage/slides/4.jpg" alt="Microprocessor" /></li>
                </ul>

                <span class="arrow previous"></span>
                <span class="arrow next"></span>
            </div>
        </div>

        <div id="banner-wrapper">
            <div id="banner">
                <div id="slideshow-overlay" class="container 80%">
                    <div class="row">
                        <div class="3u">
                            <a id="LogoWelcomePicture" href="$ThemeDir/images/GenXYZ_dc.jpg" class="image fit"><img src="$ThemeDir/images/GenXYZ_dc.jpg" alt="Logo Welcome Picture" /></a>
                        </div>
                        <div class="9u">
                            <div class="text">
                                <h2>$WelcomeTitle</h2>
                                <p>$WelcomeMessage</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="4u">
                            <ul>
                                <li><a class="button big icon fa-arrow-circle-right" href="isnetwork">Students</a></li>
                            </ul>
                        </div>
                        <div class="4u">
                            <ul>
                                <li><a class="button big icon fa-arrow-circle-right" href="partners-portal">Partners</a></li>
                            </ul>
                        </div>
                        <div class="4u">
                            <ul>
                                <li><a id="see-more-button" class="button big icon fa-arrow-circle-right" href="#">See More</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </article>
    $Form
    $PageComments
</div>
<script src="{$ThemeDir}/javascript/slideshow.js"></script>
<script src="{$ThemeDir}/javascript/autoload.js"></script>

<% include Footer %>
