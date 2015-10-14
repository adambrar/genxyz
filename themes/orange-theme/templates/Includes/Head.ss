<!DOCTYPE html>

<!--[if !IE]><!-->
<html lang="$ContentLocale" dir="$i18nScriptDirection">
<!--<![endif]-->
<!--[if IE 6 ]><html lang="$ContentLocale" class="ie ie6"><![endif]-->
<!--[if IE 7 ]><html lang="$ContentLocale" class="ie ie7"><![endif]-->
<!--[if IE 8 ]><html lang="$ContentLocale" class="ie ie8"><![endif]-->
<head>
	<% base_tag %>
	<title>$Title &raquo; $SiteConfig.Title</title>
	<meta charset="utf-8">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	$MetaTags(false)
	<!--[if lt IE 9]>
	<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
    <script src="$ThemeDir/javascript/jquery.min.js"></script>
	<script src="$ThemeDir/javascript/bootstrap.min.js"></script>
    <script src="$ThemeDir/javascript/jquery.dropotron.min.js"></script>
    <script src="$ThemeDir/javascript/skel.min.js"></script>
    <script src="$ThemeDir/javascript/skel-layers.min.js"></script>
    <script src="$ThemeDir/javascript/init.js"></script>
    <script src="$ThemeDir/javascript/selectload.js"></script>
    <script src="$ThemeDir/javascript/scrolllink.js"></script>
    <noscript>
        <% require themedCSS('bootstrap.min') %>
        <% require themedCSS('skel') %>
        <% require themedCSS('style') %>
        <% require themedCSS('style-desktop') %>
        <% require themedCSS('font-awesome.min') %>
    </noscript>
    <% require themedCSS('blog') %>
    <% require themedCSS('forum') %>
    <% require themedCSS('flag-icon.min') %>
    <% require themedCSS('comments') %>
    <link rel="shortcut icon" href="$ThemeDir/images/favicon.ico" />
    <script src="//v2.zopim.com/?39aomudjMro4sj32xkLd9VcIVHhpvx1G" charset="utf-8" type="text/javascript"></script>
    <script src="$ThemeDir/javascript/zopimbuttons.js"></script>
    <script src="https://d26b395fwzu5fz.cloudfront.net/3.2.7/keen.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        var client = new Keen({
            projectId: "5605a82a46f9a7307c9cb3b3",
            writeKey: "6d42cd558a4c384376574747aec757a3541efcf2f93b10a03845947e82ad66e737fc707f818c490c60a3ecd13f54e0433260e8af23891e288d76817e27e4a11d0fa21502b68271538a60a98cead2636191007d5bfde000df87bb65baabaa06becd3d85af8c774379c1eb7aa2ab9e0a51",
            readKey: "dc905690f03879d0d5b0674bf0852a0259a21edad48b25d31a2b9c84af8affef0df81ee983a119a19b6957bb054e99756fdb34d2a2facfda180716767281f04640cd5733d35547bf9cbdbe0fc131d86e03dd1bdaed9be14e19e9b02e263e2cc8f321363e531cda77df24f1a8e3b445ac"});
    </script>
    <script type="text/javascript">
        var pageLoadTimestamp = new Date();
        $.get("http://ipinfo.io", function (response) {
            var pageViewEvent = {
                page: location.pathname,
                user: {
                    ip: response['ip'],
                    country: response['country']
                },
                keen: {
                    timestamp: pageLoadTimestamp
                }
            };
            client.addEvent("pageviews", pageViewEvent, function(err,res){
                
            });
        }, "jsonp");
    </script>

</head>