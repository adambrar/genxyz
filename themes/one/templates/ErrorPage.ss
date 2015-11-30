<% include Head %>
<body id="home" class="$ClassName homepage" <% if $i18nScriptDirection %>dir="$i18nScriptDirection"<% end_if %>>
    <% include EmptyHeader %>
    <div class="row margin-bottom margin-top">
        <div class="text-center col-md-6 col-md-offset-3 wow fadeInLeft">
            <h1><span style="color:red;weight:bold;font-size:3em">404</span></h1>
            <h1>$Title</h1>
            $Content
            <i style="color:red" class="fa fa-search fa-4x"></i>
            $Form
        </div>
    </div>


    <% include Footer %>
        
</body>
</html>
