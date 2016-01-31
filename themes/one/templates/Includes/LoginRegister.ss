<div class="row margin-bottom">            
    <div class="tab-content col-sm-6 col-sm-offset-3" style="min-height:380px;background-color:transparent;">
        <% if BrowseLink %><p class=""><a class="wow fadeInUp btn btn-default" data-wow-delay="300ms" href="{$BrowseLink}"> <i class="fa fa-arrow-right"></i> Browse all available $Title</a></p><% end_if %>
        <div id="login" class="tab-pane fade in active wow fadeInRight">
            <h3>Login</h3>
            $LoginForm
        </div>
        <div id="register" class="tab-pane wow fadeInLeft">
            <h3>Register</h3>
            <% with Page(student) %>
                $getStudentRegisterForm
            <% end_with %>
        </div>
    </div>
</div>