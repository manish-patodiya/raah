<?php

namespace App\Controllers;

class Frontend extends BaseController
{
    public function __construct()
    {
        $this->FrontendModel = model('FrontendModel');
        $this->TestimonialModel = model('TestimonialModel');
        $this->NotificationModel = model('NotificationModel');
        $this->ProductModel = model('CategoryModel');
    }

    public function index()
    {
        $details = $this->FrontendModel->get_by_id(1);
        $testimonials = $this->TestimonialModel->get_testimonials();
        $data = [
            "content" => "home",
            "full_header" => true,
            "assets" => [
                "js" => [
                    "public/frontend/custom/js/home.js",
                ],
                "css" => [
                    "public/frontend/custom/css/home.css",
                ],
            ],
            "data" => [
                "testimonials" => $testimonials,
            ],
        ];
        if (isset($this->session->customer_info) && $this->session->customer_info) {
            $notifications = $this->NotificationModel->get_user_screen_notification($this->session->customer_info["user_id"]);
            $data = array_merge(["session" => $this->session->customer_info, "notifications" => $notifications], $data);
        }
        return view('frontend/template', $data);
    }

    public function home()
    {
        $this->index();
    }

    public function about()
    {
        //$details = $this->FrontendModel->get_by_id(2);
        //$product_categories = $this->
        $data = [
            "content" => "about",

        ];
        return view('frontend/template', $data);
    }

    public function production_process()
    {
        //$details = $this->FrontendModel->get_by_id(2);
        //$product_categories = $this->
        $data = [
            "content" => "production_process",

        ];
        return view('frontend/template', $data);
    }

    public function news()
    {
        return view('frontend/news');
    }

    public function what_we_do()
    {
        $data = [
            "content" => "whatwedo",

        ];
        return view('frontend/template', $data);
    }

    public function our_mission()
    {
        $data = [
            "content" => "our_mission",

        ];
        return view('frontend/template', $data);
    }

    public function get_involve()
    {
        $data = [
            "content" => "getinvolve",

        ];
        return view('frontend/template', $data);
    }

    public function about_ktdc()
    {
        $data = [
            "content" => 'about',

        ];
        return view('frontend/template', $data);
    }

    public function donate()
    {
        $data = [
            "content" => "donate",
            "full_header" => true,
            "assets" => [
                "js" => [
                    "public/frontend/custom/js/donate.js",
                ],
                "css" => [
                    "public/frontend/custom/css/donate.css",
                ],
            ],
            "data" => [],
        ];
        return view('frontend/template', $data);
    }

    public function contact_us()
    {
        $data = [
            "content" => 'contact_us',
            "header" => 'header_bottom',
        ];
        return view('frontend/template', $data);
    }

    public function contact_form_enquiry()
    {
        $post_data = $this->request->getGet();
        // prd($post_data);
        if ($this->validation->run($post_data, 'contact_form')) {
            $result = $this->FrontendModel->add_contact_enquiry($post_data);
            if ($result) {
                echo json_encode([
                    "status" => 1,
                    "msg" => "Your message is inserted successfully",
                ]);
            }
        } else {
            $errors = $this->validation->getErrors();
            echo json_encode([
                "error" => $errors,
                "status" => 0,
            ]);
        }
    }
    public function terms_and_conditions()
    {
        $data = [
            "content" => 'policy_page',
            "header" => 'header_bottom',
            "details" => $this->FrontendModel->get_by_id(3),
        ];
        return view('frontend/template', $data);
    }

    public function privacy_policy()
    {
        $data = [
            "content" => 'policy_page',
            "header" => 'header_bottom',
            "details" => $this->FrontendModel->get_by_id(4),
        ];
        return view('frontend/template', $data);
    }

    public function cancellation_policy()
    {
        $data = [
            "content" => 'policy_page',
            "header" => 'header_bottom',
            "details" => $this->FrontendModel->get_by_id(5),
        ];
        return view('frontend/template', $data);
    }

    public function returns_refunds_replacement_policy()
    {
        $data = [
            "content" => 'policy_page',
            "header" => 'header_bottom',
            "details" => $this->FrontendModel->get_by_id(6),
        ];
        return view('frontend/template', $data);
    }

    public function responsible_disclosure_policy()
    {
        $data = [
            "content" => 'policy_page',
            "header" => 'header_bottom',
            "details" => $this->FrontendModel->get_by_id(7),
        ];
        return view('frontend/template', $data);
    }

    public function intellectual_property_policy()
    {
        $data = [
            "content" => 'policy_page',
            "header" => 'header_bottom',
            "details" => $this->FrontendModel->get_by_id(8),
        ];
        return view('frontend/template', $data);
    }

    public function anti_plishing_alert()
    {
        $data = [
            "content" => 'policy_page',
            "header" => 'header_bottom',
            "details" => $this->FrontendModel->get_by_id(9),
        ];
        return view('frontend/template', $data);
    }

    public function notification()
    {
        if (isset($this->session->customer_info) && $this->session->customer_info) {
            $notifications = $this->NotificationModel->get_user_screen_notification($this->session->customer_info["user_id"]);
            // prd($notifications);
            echo json_encode([
                "status" => 1,
                "notifications" => $notifications,
            ]);
        } else {
            echo json_encode([
                "status" => 0,
            ]);
        }
    }

    public function faqs()
    {
        $data = [
            "content" => 'faqs',
            "header" => 'header_bottom',
            "faqs" => $this->FrontendModel->faqs(),
        ];
        return view('frontend/template', $data);
    }

    //Subscribe for newslater
    public function subscribe_newslater()
    {
        if (filter_var($this->request->getPost("email"), FILTER_VALIDATE_EMAIL)) {
            $result = $this->FrontendModel->subscribe_newslater($this->request->getPost("email"));
            if ($result) {
                json_response(1, "Your email has been subscribed.");
            }
        } else {
            $errors = $this->validation->getErrors();
            json_response(0, "Your input email is not valid");
        }
    }
}