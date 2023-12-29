<?php

make_list_view($categories_list);

function make_list_view($categories_list, $pid = 0)
{
    foreach ($categories_list as $value) {
        if ($value->pid == $pid) {
            $url = base_url("products?c=$value->id");
            if (check_pid($categories_list, $value->id)) {
                echo "<div class='d-flex align-items-center cat-row pb-1'>
                        <a class='row-cat' data-bs-toggle='collapse' href='#child$value->id' aria-expanded='false' aria-controls='child$value->id'>
                            <i class='mdi mdi-plus-box'></i>
                            <span class='pe-2'>$value->category_name</span>
                        </a>";
                echo make_action_div($value->id);
                echo "</div><div class='collapse ps-4' id='child$value->id'>";
                make_list_view($categories_list, $value->id);
                echo "</div>";
            } else {
                echo "<div class='d-flex align-items-center cat-row pb-1'>
                        <i class='mdi mdi-checkbox-blank-circle pe-1'></i>
                        <span class='pe-2'>$value->category_name</span>";
                echo make_action_div($value->id);
                echo "</div>";
            }
        }
    }
}

function make_action_div($cat_id)
{
    $action = '<div style="display:none" class="div-cat-actions">
    <a title="Select" class="text-primary slct-cat me-1" href="#" cat_id="' . $cat_id . '" style="font-size: 0.9rem;"> <i class="fa fa-plus"></i></a><a title="Edit" class="text-warning sup_update me-1" href="#" cate_id="' . $cat_id . '" style="font-size: 0.9rem;"> <i class="fa fa-pencil-square-o"></i></a></div>';
    return $action;
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