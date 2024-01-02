<div style="overflow: hidden;
border-bottom: 2px solid #b7b7b7;
padding-bottom: 5px;">
<a href="../index.html">
<div id="logo">
</div>
</a>

<div id="caption">DEMO SITE <small><?php echo $version ?></small>
</div>

</div>
<a id="buy-button"></a>
<ul id="st">
    <li class="<?php echo $theme == 'default' ? 'active' : '' ?>">
        <a href="index.php?page=<?php echo $page ?>&theme=default">Default theme</a>
    </li>
     <li class="<?php echo $theme == 'bootstrap5' ? 'active' : '' ?>">
        <a href="index.php?page=<?php echo $page ?>&theme=bootstrap5">Bootstrap theme (5.0) <span class="new">NEW</span></a>
    </li>
    <li class="<?php echo $theme == 'semantic' ? 'active' : '' ?>">
        <a href="index.php?page=<?php echo $page ?>&theme=semantic">Semantic UI (2.4) <span class="new">NEW</span></a>
    </li>
    <li class="<?php echo $theme == 'bootstrap4' ? 'active' : '' ?>">
        <a href="index.php?page=<?php echo $page ?>&theme=bootstrap4">Bootstrap theme (4.*) <span class="new">NEW</span></a>
    </li>
    <li class="<?php echo $theme == 'bootstrap' ? 'active' : '' ?>">
        <a href="index.php?page=<?php echo $page ?>&theme=bootstrap">Bootstrap theme (3.0)</a>
    </li>
    <li class="<?php echo $theme == 'minimal' ? 'active' : '' ?>">
        <a href="index.php?page=<?php echo $page ?>&theme=minimal">Minimal theme</a>
    </li>
</ul>


