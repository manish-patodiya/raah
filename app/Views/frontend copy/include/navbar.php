<?php
$navbar_items = model('CategoryModel')->getAll();
?>

<style>
.sm-blue>li:last-child>a,
.sm-blue>li:last-child> :not(ul) a {
    border-radius: 0 !important;
}
</style>

<nav class="main-nav bg-white p-0 bb-1" style="border-color: #ccc !important;" role="navigation">
    <!-- Mobile menu toggle button (hamburger/x icon) -->
    <input id="main-menu-state" type="checkbox" />
    <label class="main-menu-btn" for="main-menu-state">
        <span class="main-menu-btn-icon"></span> Toggle main menu visibility
    </label>
    <ul id="main-menu" class="sm sm-blue rounded-0 p-0">
        <?php make_nav_bar($navbar_items)?>
    </ul>
</nav>

<?php
function make_nav_bar($navbar_items, $pid = 0)
{
    foreach ($navbar_items as $value) {
        if ($value->pid == $pid) {
            $url = base_url("products?cat=$value->id");
            if (check_pid($navbar_items, $value->id)) {
                echo "<li class='p-0'><a href='#' class='rounded-0 m-0'>" . $value->category_name . "</a>";
                echo "<ul>";
                make_nav_bar($navbar_items, $value->id);
                echo "</ul>";
            } else {
                echo "<li class='p-0'><a href='$url' class='rounded-0 m-0'>" . $value->category_name . "</a>";
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