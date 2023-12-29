<?php

namespace App\Controllers\Admin\Settings;

use App\Controllers\Admin\AdminController;

class GeneralSetting extends AdminController
{
    public $general_setting;
    public $companymodel;
    public $citymodel;
    public $countrymodel;
    public $rolesmodel;
    public $statemodel;
    public $usermodel;

    public function __construct()
    {
        parent::__construct();
        check_access('generalsetting');
        $this->general_setting = model('GeneralSetting');
        $this->citymodel = model('CityModel');
        $this->countrymodel = model('CountryModel');
        $this->rolesmodel = model('UserRolesModel');
        $this->statemodel = model('StateModel');
        $this->usermodel = model('UserModel');
        $this->profilemodel = model('ProfileModel');
    }
    public function index()
    {
        $data['session'] = $this->session;
        $data['general_settings'] = $this->general_setting->getAll();
        // prd($data);
        return view('admin/general_setting/general_setting', $data);
    }
    // genernal setting add for company details

    public function edit_general_setting()
    {
        $data = [
            "application_name" => $this->request->getPost('app_name'),
            "copyright" => $this->request->getPost('copyright'),
            // "timezone" => $this->request->getPost('time_zone'),
            // "currency" => $this->request->getPost('currency'),
            // "default_language" => $this->request->getPost('default_lang'),
        ];
        if ($this->request->getFile('favicon') != "") {
            $data["favicon"] = $this->_upload_favicon();
        }
        if ($this->request->getFile('logo') != "") {
            $data["logo"] = $this->_upload_logo();
        }
        $result = $this->general_setting->updateData($data);
        $site_info = $this->general_setting->getAll();
        $this->session->set("site_info", $site_info);
        if ($result) {
            echo json_encode([
                "status" => 1,
                "msg" => "General setting updated successfully",
            ]);
        }
    }

    public function edit_email_setting()
    {
        $data = [
            "email_from" => $this->request->getPost('eamil_from'),
            "smtp_host" => $this->request->getPost('smtp_host'),
            "smtp_port" => $this->request->getPost('smtp_port'),
            "smtp_user" => $this->request->getPost('smtp_user'),
            "smtp_pass" => $this->request->getPost('smtp_password'),
        ];
        $result = $this->general_setting->updateData($data);
        if ($result) {
            echo json_encode([
                "status" => 1,
                "msg" => "Email setting updated successfully",
            ]);
        }
    }

    // genernal setting update for company details
    // public function edit($id)
    // {
    //     if ($this->request->getPost('submit')) {
    //         $user_id = $this->request->getPost('user_id');
    //         $data = array(
    //             'email' => $this->request->getPost('email'),
    //             'phone' => $this->request->getPost('mobile_no'),
    //             'address' => format_name($this->request->getPost('address')),
    //             'status' => 1,
    //         );
    //         $res = $this->usermodel->updateRow($data, "id=$user_id");

    //         $data1 = array(
    //             'name' => format_name($this->request->getPost('companyname')),
    //             'iec_code' => $this->request->getPost('ieccode'),
    //             'website_url' => $this->request->getPost('website'),
    //             'state_id' => $this->request->getPost('state_id'),
    //             'city_id' => $this->request->getPost('citie_id'),
    //             'email' => $this->request->getPost('email'),
    //             'mobile' => $this->request->getPost('mobile_no'),
    //             'address' => format_name($this->request->getPost('address')),

    //         );

    //         if (!empty($_FILES['logo']['name'])) {
    //             $data1 = array_merge($data1, ['logo' => $this->_upload_logo()]);
    //         }
    //         $res1 = $this->companymodel->updateRow($data1, "id=$id");
    //         $role_id = $this->session->get('admin_info')['active_role_id'];

    //         $this->usermodel->update_cuser_role($id, $user_id, $role_id);

    //         if ($res && $res1) {
    //             echo json_encode([
    //                 "status" => 1,
    //                 "msg" => "Company details updated successfully",
    //             ]);
    //         }
    //     }
    // }

    // genernal setting update for branch details
    public function edit_branch($id)
    {
        $user_id = $this->request->getPost('user_id');
        $data = array(
            'email' => $this->request->getPost('email'),
            'phone' => $this->request->getPost('mobile_no'),
            'state_id' => $this->request->getPost('state'),
            'city_id' => $this->request->getPost('citie'),
            'address' => format_name($this->request->getPost('address')),
        );
        $user = $this->usermodel->updateRow($data, "id=$user_id");
        $data1 = array(
            'name' => format_name($this->request->getPost('branches_name')),
            'state_id' => $this->request->getPost('state'),
            'iec_code' => $this->request->getPost('ieccode'),
            'city_id' => $this->request->getPost('citie'),
            'email' => $this->request->getPost('email'),
            'phone' => $this->request->getPost('mobile_no'),
            'branches_date' => $this->request->getPost('branches_date'),
            'address' => $this->request->getPost('address'),
        );
        $gst_no = $this->request->getPost('gst_no');
        $data1 = array_merge($data1, ['gst_no' => $gst_no]);
        $admin_info = $this->session->get('admin_info');
        $admin_info['gst_no'] = $gst_no;
        $this->session->set('admin_info', $admin_info);

        $branches_id = $this->branches->updateRow($data1, "id=$id");
        $data2 = array(
            'company_id' => $this->session->get('admin_info')['company_id'],
            'user_id' => $user_id,
            'branch_id' => $id,
        );
        $update = $this->branches->update_cuser_role($data2, "branch_id=$id");

        echo json_encode([
            "status" => 1,
            "msg" => "Branches details updated successfully",
        ]);
        // }
    }

    public function add_invoice_concept()
    {
        $data['trans_concept_id'] = $this->request->getPost('group4');
        $company_id = $this->session->get('admin_info')['company_id'];
        $result = $this->companymodel->insertTransConceptId($data, $company_id);
        $branches = $this->companymodel->getBranches($company_id);
        $non_updated_branch = [];
        $data['is_updated'] = "1";
        foreach ($branches as $k => $v) {
            $rows = $this->branches->check_is_updated($v->branch_id);
            // Getting branch id invoices

            if ($rows) {
                $non_updated_branch[] .= $this->branches->updateRow($data, 'id=' . $rows->id);
            }

        }
        if ($result) {
            echo json_encode([
                "status" => 1,
                "msg" => "Invoice concept updated successfully",
            ]);
        }
    }
    private function _upload_logo()
    {
        $logo = $this->request->getFile('logo');
        // prd($logo);
        $file_path = '';
        if ($logo->isValid()) {
            $upload_path = 'public/uploads/companise_logo/';
            $logo_name = $logo->getRandomName();
            $res = $logo->move($upload_path, $logo_name);
            // $res1 = $favicon->move($upload_path, $favicon_name);
            if ($res) {
                $file_path = base_url($upload_path . $logo_name);
            }
        }
        return $file_path;

    }
    public function _upload_favicon()
    {
        $favicon = $this->request->getFile('favicon');
        // prd($favicon);
        $file_path = '';
        if ($favicon->isValid()) {
            $upload_path = 'public/uploads/companise_logo/';
            $favicon_name = $favicon->getRandomName();
            $res = $favicon->move($upload_path, $favicon_name);
            // prd($res);
            if ($res) {
                $file_path = base_url($upload_path . $favicon_name);
            }
        }
        return $file_path;
    }
    public function add_branch_invoice_concept()
    {
        $data['trans_concept_id'] = $this->request->getPost('group4');
        $data['is_updated'] = "1";
        $branch_id = $this->session->get('admin_info')['branch_id'];
        $result = $this->branches->insertTransConceptId($data, $branch_id);
        if ($result) {
            echo json_encode([
                "status" => 1,
                "msg" => "Invoice concept updated successfully",
            ]);
        }
    }

    public function start_no()
    {
        $data['start_no'] = $this->request->getPost('start_no');
        $company_id = $this->session->admin_info['company_id'];
        $branches = $this->companymodel->getBranches($company_id);
        // Getting all branches of login company

        $non_trans_branch_id = [];
        // A array type variable to store non transaction branch ids.

        foreach ($branches as $k => $v) {
            $rows = $this->transactionmodel->getFeild($v->branch_id, $v->company_id);
            // Getting branch id invoices

            if ($rows == "") {
                $non_trans_branch_id[] .= $v->branch_id;
            }
        }
        $result = $this->general_setting->updateStartNo($data, $non_trans_branch_id);
        $result = $this->companymodel->insertTransConceptId($data, $company_id);
        if ($result) {
            echo json_encode([
                "status" => 1,
                "msg" => "Start no updated successfully",
            ]);
        }
    }

    public function menu()
    {
        $data['session'] = $this->session;
        return view('admin/settings/menu', $data);
    }
}