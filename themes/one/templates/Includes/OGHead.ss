<!DOCTYPE html>

<!--[if !IE]><!-->
<html lang="$ContentLocale">
<!--<![endif]-->
<!--[if IE 6 ]><html lang="$ContentLocale" class="ie ie6"><![endif]-->
<!--[if IE 7 ]><html lang="$ContentLocale" class="ie ie7"><![endif]-->
<!--[if IE 8 ]><html lang="$ContentLocale" class="ie ie8"><![endif]-->
<head>
	<% base_tag %>
	<title><% if $MetaTitle %>$MetaTitle<% else %>$Title<% end_if %> || $SiteConfig.Title</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	$MetaTags(false)
	<!--[if lt IE 9]>
    <script src="$ThemeDir/javascript/html5shiv.js"></script>
    <script src="$ThemeDir/javascript/respond.min.js"></script>
    <![endif]-->
	<% require themedCSS('bootstrap.min') %>
	<% require themedCSS('animate.min') %>
	<% require themedCSS('font-awesome.min') %>
	<% require themedCSS('owl.carousel') %>
	<% require themedCSS('owl.transitions') %>
	<% require themedCSS('prettyPhoto') %>
	<% require themedCSS('main') %>
	<% require themedCSS('responsive') %>
	<link rel="shortcut icon" href="$ThemeDir/images/logo.ico" />
    <meta property="og:url" content=$Link />
    <meta property="og:type" content="website" />
    <meta property="og:title" content=$Title />
    <meta property="og:description" content=$Content.LimitCharacters(300) />
    <meta property="og:image" content="http://www.your-domain.com/path/image.jpg" />

</head>