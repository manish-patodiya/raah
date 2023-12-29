<?php

namespace App\Controllers\Admin\Settings;

use App\Controllers\Admin\AdminController;

class Roles extends AdminController
{
    public function __construct()
    {
        parent::__construct();
        check_access('roles');
        $this->UserRoles = model('UserRolesModel');
        $this->Modules = model('Modules');
    }

    public function index()
    {
        $roles = $this->UserRoles->getRoles();
        $data = [
            'session' => $this->session,
            'roles' => $roles,
        ];
        return view('admin/roles/roleslist', $data);
    }

    public function permissions($role_id)
    {
        check_method_access('roles', 'view');
        $modules = $this->Modules->getAllAdminModules();
        $permissions = $this->Modules->getPermissions($role_id);
        $perm_arr = [];
        foreach ($permissions as $k => $v) {
            $perm_arr[$v->module_id][] = $v->operation;
        }
        $data = [
            'session' => $this->session,
            'role_id' => $role_id,
            'modules' => $modules,
            'permissions' => $perm_arr,
        ];
        return view('admin/roles/permissions', $data);
    }

    public function update_permissions()
    {
        check_method_access('roles', 'edit');
        $post_data = $this->request->getPost();
        $role_id = $post_data['role_id'];
        $res = $this->Modules->deletePermissions($role_id);
        $modules = isset($post_data['module']) ? $post_data['module'] : [];
        $permissions = isset($post_data['permission']) ? $post_data['permission'] : [];
        $data = [];
        foreach ($permissions as $k => $p) {
            $data[] = [
                'role_id' => $role_id,
                'operation' => $p,
                'module_id' => $modules[$k],
            ];
        }
        if (!empty($data)) {
            $res = $this->Modules->setPermissions($data);
            if ($res) {
                if ($role_id == $this->session->get('admin_info')['active_role_id']) {
                    set_permissions_in_session($role_id);
                }
                json_response(1, "Update Successfully");
            }
        } else {
            json_response(1, "Update Successfully");
        }
    }

}
