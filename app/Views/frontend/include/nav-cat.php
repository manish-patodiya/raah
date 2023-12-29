<?php
$navbar_items = model('CategoryModel')->getAll();
function render_category($navbar_items, $pid = 0)
{
    foreach ($navbar_items as $value) {
        if ($value->pid == $pid) {
            $url = base_url("products?cat=$value->id");
            if (check_pid($navbar_items, $value->id)) {
                echo "<li class='cat-menu'><a href='#'>" . $value->category_name . "</a>";
                echo "<ul class='cat-sub-menu'>";
                render_category($navbar_items, $value->id);
                echo "</ul></li>";
            } else {
                echo "<li><a href='$url'>" . $value->category_name . "</a></li>";
            }
        }
    }
}

function check_pid($items, $pid)
{
    foreach ($items as $v) {
        if ($v->pid == $pid) {
            return true;
        }
    }
    return false;
}
?>
<div id="nav-category" class="nav-category">
    <div class="category-container">
        <!-- Mobile menu toggle button (hamburger/x icon) -->
        <ul>
            <?php render_category($navbar_items)?>
        </ul>
    </div>
</div>