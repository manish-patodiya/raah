<?php

make_list_view($categories_list);

function make_list_view($categories_list, $pid = 0)
{
    foreach ($categories_list as $value) {
        if ($value->pid == $pid) {
            $url = base_url("products?c=$value->id");
            if (check_pid($categories_list, $value->id)) {
                echo "<div class='d-flex align-items-center cat-row p-15 fs-18'>
                        <a class='row-cat' data-bs-toggle='collapse' href='#child$value->id' aria-expanded='false' aria-controls='child$value->id'>
                            <i class='mdi mdi-plus-box'></i>
                            <span class='pe-2'>$value->category_name</span>
                        </a>";
                echo make_action_div($value->id);
                echo "</div><div class='collapse ps-4' id='child$value->id'>";
                make_list_view($categories_list, $value->id);
                echo "</div>";
            } else {
                echo "<div class='d-flex align-items-center cat-row p-15 fs-18'>
                        <i class='mdi mdi-checkbox-blank-circle pe-1 text-white'></i>
                        <span class='pe-2'>$value->category_name</span>";
                echo make_action_div($value->id);
                echo "</div>";
            }
        }
    }
}

function make_action_div($cat_id)
{
    $action = '<div style="display:none" class="div-cat-actions">';
    $action .= '<a title="Add child category" class="text-primary slct-cat me-1" href="#" cat_id="' . $cat_id . '" > <i class="fa fa-plus"></i></a>';

    if (check_method_access('categories', 'edit', true)) {
        $action .= '<a title="Edit this category" class="text-warning sup_update me-1" href="#" cate_id="' . $cat_id . '"> <i class="fa fa-pencil-square-o"></i></a>';
    }

    if (check_method_access('categories', 'delete', true)) {
        // $action .= '<a title="Delete" class="text-danger sup_delete me-1"  uid="' . $cat_id . '" href="#" title="Delete" style="font-size: 0.9rem;" > <i class="fa fa-trash-o"></i></a>';
    }
    $action .= '</div>';
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