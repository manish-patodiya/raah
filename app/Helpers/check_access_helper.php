<?php
function set_permissions_in_session()
{
    $session = service('session');
    $role_id = $session->admin_info['active_role_id'];
    $user_permissions = model('Modules')->getPermissionsForSession($role_id);
    $user_info = $session->get('admin_info');
    $permissions = [];
    foreach ($user_permissions as $p) {
        $permissions[$p->controller][] = $p->operation;
    }
    $user_info['permissions'] = $permissions;
    $session->set('admin_info', $user_info);
}

function print_permission_menu($permissions, $modules, $mid = 0)
{
    echo "<div class='ml-5'>";
    foreach ($modules as $k => $v) {
        if ($v->pid == $mid) {
            $flex = '';
            if ($v->operations) {
                $flex = 'd-flex align-items-center';
            }
            echo '<div class="mx-4 ' . $flex . '"><h4 class="col-md-4">' . ucwords(str_replace('_', ' ', $v->title)) . '</h4>';
            if ($v->operations) {
                $frmt_title = str_replace(" ", "-", strtolower($v->title));
                $operations = explode('|', $v->operations);
                echo '<div class="col-md-8">';
                foreach ($operations as $op) {
                    $chckd = '';
                    if (isset($permissions[$v->id]) && in_array($op, $permissions[$v->id])) {
                        $chckd = 'checked';
                    }
                    // <label for='module-$frmt_title-$op'>module</label>
                    echo "<input type='checkbox' $chckd name=module[] value='$v->id' id='module-$frmt_title-$op' class='module'/>";
                    echo '<input name="permission[]" type="checkbox" id="' . "$frmt_title-$op" . '" class="chk-col-info permission" value="' . $op . '" ' . $chckd . '>
                    <label for="' . "$frmt_title-$op" . '" style="margin-right:3.4rem">' . ucfirst($op) . '</label>';
                }
                echo '</div>';
            }
            echo print_permission_menu($permissions, $modules, $v->id);
            echo '</div>';
            if ($v->pid == 0) {
                echo "<hr class=''>";
            }
        }
    }
    echo "</div>";
}

function check_access($name)
{
    if (!check_module_access($name)) {
        header('Location:' . base_url());exit;
    } else {
        return true;
    }
}

function check_module_access($module)
{
    $session = service('session');
    if ($session->admin_info['active_role_id'] == ADMIN_ROLE_ID) {
        return true;
    }
    $permissions = $session->get('admin_info')['permissions'];
    if (isset($permissions[strtolower($module)])) {
        return true;
    } else {
        return false;
    }
}

function check_method_access($module, $operation, $rstat = false)
{
    $session = service('session');
    if ($session->admin_info['active_role_id'] == ADMIN_ROLE_ID) {
        return true;
    }
    $permissions = $session->get('admin_info')['permissions'];
    if (isset($permissions[strtolower($module)]) && in_array($operation, $permissions[strtolower($module)])) {
        return true;
    } else if ($rstat) {
        return false;
    } else {
        echo "<div style='display:flex; justify-content:center;'><h1>You don't have permission for this page</h1></div>";
        exit;
    }
}

function check_admin_login()
{
    $session = service('session');
    if (!$session->get('is_login') || !$session->get('is_admin')) {
        header("Location:" . base_url('admin'));
        exit;
    } else if (!$session->admin_info['active_role_id']) {
        header("Location:" . base_url("auth/loginAs"));
        exit;
    }
}

function check_seller_login()
{
    $session = service('session');
    if (!$session->get('is_login') || !$session->get('is_seller')) {
        header("Location:" . base_url('seller'));
        exit;
    }
}

function check_seller_store()
{
    $session = service('session');
    if ($session->seller_info['store_count']) {
        return true;
    } else {
        return false;
    }
}

function check_customer_login()
{
    $session = service('session');
    if (!$session->get('is_login') || !$session->get('is_customer')) {
        header("Location:" . base_url('customer'));
        exit;
    }
}

function error404()
{
    throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
}

function url_expired()
{
    echo "<span style='font-size:20px;'>This url has been expired</span>";
    die;
}