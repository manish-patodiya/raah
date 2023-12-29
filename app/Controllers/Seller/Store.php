<?php

namespace App\Controllers\Seller;

use App\Controllers\BaseController;

class Store extends BaseController
{
    public function __construct()
    {
        check_seller_login();
        $this->state_model = model("StateModel");
        $this->city_model = model("CityModel");
        $this->country_model = model("CountryModel");
        $this->store_model = model('StoreModel');
    }

    public function index()
    {
        $user_id = $this->session->seller_info['user_id'];
        $info = model('UserModel')->get($user_id);
        $data = [
            'session' => $this->session,
            'info' => $info,
            'states' => $this->state_model->getStates(),
            'cities' => $this->city_model->getAll(),
            'countries' => $this->country_model->getAll(),
        ];
        return view('seller/store/create_store', $data);
    }

    public function create_store()
    {
        $post_data = $this->request->getPost();
        if ($this->validation->run($post_data, "add_store")) {
            $store_id = $this->store_model->createStore($post_data);
            // prd($store_id);
            if ($store_id) {
                echo json_encode([
                    "status" => 1,
                    "msg" => "Store added successfully",
                ]);
            } else {
                echo json_encode([
                    "status" => 0,
                    "msg" => "Something went wrong",
                ]);
            }
        } else {
            echo json_encode([
                'status' => 0,
                'msg' => "Form validation error",
                'errors' => $this->validation->getErrors(),
            ]);
        }
    }
    public function getStates()
    {
        $country_id = $this->request->getPost('id');
        // prd($country_id);
        $data = $this->state_model->get_states_by_country($country_id);
        echo json_encode([
            "status" => 1,
            "data" => $data,
            "msg" => "Successfully fetched",
        ]);
    }

    public function getCities()
    {
        $id = $this->request->getPost('id');
        $cities = $this->city_model->get_cities_state_id($id);
        echo json_encode([
            'status' => 1,
            'data' => $cities,
            'msg' => 'successfully Fetched',
        ]);

    }
}