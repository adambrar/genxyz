<nav class="primary">
    <ul id="hornavmenu" class="nav navbar-nav">
        <% loop $Menu(1) %>
            <li>
                <a href="$Link" title="$Title.XML"><i class="fa-$Top.MenuIcon"></i>$MenuTitle.XML</a>
            </li>
        <% end_loop %>
    </ul>
</nav>
