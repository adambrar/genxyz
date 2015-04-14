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
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
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
    <noscript>
        <% require themedCSS('bootstrap.min') %>
        <% require themedCSS('skel') %>
        <% require themedCSS('style') %>
        <% require themedCSS('style-desktop') %>
        <% require themedCSS('font-awesome.min') %>
    </noscript>
    <% require themedCSS('blog') %>
    <% require themedCSS('forum') %>
    <link rel="shortcut icon" href="$ThemeDir/images/favicon.ico" />
    <script src="//v2.zopim.com/?2uDfL8QV5WgywsgloRQMbP785ruTgGtR" charset="utf-8" type="text/javascript"></script>
</head>