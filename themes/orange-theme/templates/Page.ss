<% include Head %>
<body class="$ClassName<% if not $Menu(2) %> no-sidebar<% end_if %>" <% if $i18nScriptDirection %>dir="$i18nScriptDirection"<% end_if %>>
<% require javascript('framework/thirdparty/jquery/jquery.js') %>

    $Layout

</body>
</html>
