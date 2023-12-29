<?php

namespace Config;

use App\Validation\CustomRules;
use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Validation\CreditCardRules;
use CodeIgniter\Validation\FileRules;
use CodeIgniter\Validation\FormatRules;
use CodeIgniter\Validation\Rules;

class Validation extends BaseConfig
{
    //--------------------------------------------------------------------
    // Setup
    //--------------------------------------------------------------------

    /**
     * Stores the classes that contain the
     * rules that are available.
     *
     * @var string[]
     */
    public $ruleSets = [
        Rules::class,
        FormatRules::class,
        FileRules::class,
        CreditCardRules::class,
        CustomRules::class,
    ];

    /**
     * Specifies the views that are used to display the
     * errors.
     *
     * @var array<string, string>
     */
    public $templates = [
        'list' => 'CodeIgniter\Validation\Views\list',
        'single' => 'CodeIgniter\Validation\Views\single',
    ];

    public $product_validation = [
        "title" => 'required|min_length[2]',
        "category_id" => 'required',
        "hsn_code" => 'required',
        "gst_rate" => 'required',
        "pro_details" => 'required',
        "net_weight" => 'required',
        "quantity" => 'required',
        "country_of_origin" => 'required',
    ];

    public $product_validation_error = [
        "title" => [
            'required' => 'Product name is required',
            'min_length' => 'Product name must be greater than 2 characters',
        ],
        "category_id" => [
            'required' => 'Please select product category',
        ],
        "hsn_code" => [
            'required' => 'Please select HSN details',
        ],
        "gst_rate" => [
            'required' => 'GST rate cannot be empty',
        ],

    ];

    public $request_otp = [
        "phone" => [
            "rules" => 'required|exact_length[10]|is_unique[users.phone]',
            "errors" => [
                'required' => 'Mobile no. is required.',
                'exact_length' => 'Mobile no. must be of 10 numbers.',
                'is_unique' => 'Mobile no. is already exist.',
            ],
        ],
    ];

    public $seller_registration = [
        'full_name' => [
            'rules' => "required|min_length[4]",
            'errors' => [
                // 'required' => 'Full name is required.',
                'min_length' => 'Name is minimum of 4 characters.',
            ],
        ],
        'email' => [
            'rules' => "required|isUniqueWithWhere[users.email,is_email_verify = 1]|regex_match[{email_regex}]",
            'errors' => [
                // 'required' => 'Email is required.',
                'isUniqueWithWhere' => 'Email is already exist',
                'regex_match' => 'Not a valid email',
            ],
        ],
        'phone' => [
            'rules' => "required|exact_length[10]|is_unique[users.phone]|isPhoneVerified[{row_id}]",
            'errors' => [
                'exact_length' => 'Mobile no. must be of 10 numbers.',
                'is_unique' => 'Mobile no. is already exist',
                'isPhoneVerified' => 'Mobile no. is not verified.',
            ],
        ],
        'password' => [
            'rules' => 'required|min_length[8]|regex_match[{password_regex}]',
            'errors' => [
                'min_length' => 'Password should have minimum 8 characters',
                'regex_match' => 'Weak passoword',
            ],
        ],
        'cpassword' => [
            'rules' => 'required|min_length[8]|regex_match[{password_regex}]',
        ],
    ];

    public $seller_login = [
        'phone' => [
            'rules' => "required|exact_length[10]",
            'errors' => [
                'exact_length' => 'Mobile no. must be of 10 characters.',
            ],
        ],
        'password' => [
            'rules' => 'required',
        ],
    ];

    public $customer_registration = [
        'full_name' => [
            'rules' => "required|min_length[4]",
            'errors' => [
                // 'required' => 'Full name is required.',
                'min_length' => 'Name is minimum of 4 characters.',
            ],
        ],
        'email' => [
            'rules' => "required|isUniqueWithWhere[users.email,is_email_verify = 1]|regex_match[{email_regex}]",
            'errors' => [
                // 'required' => 'Email is required.',
                'isUniqueWithWhere' => 'Email is already exist',
                'regex_match' => 'Not a valid email',
            ],
        ],
        'phone' => [
            'rules' => "required|exact_length[10]|is_unique[users.phone]|isPhoneVerified[{row_id}]",
            'errors' => [
                'exact_length' => 'Mobile no. must be of 10 numbers.',
                'is_unique' => 'Mobile no. is already exist',
                'isPhoneVerified' => 'Mobile no. is not verified.',
            ],
        ],
        'password' => [
            'rules' => 'required|min_length[8]|regex_match[{password_regex}]',
            'errors' => [
                'min_length' => 'Password should have minimum 8 characters',
                'regex_match' => 'Weak passoword',
            ],
        ],
        'cpassword' => [
            'rules' => 'required|min_length[8]|regex_match[{password_regex}]',
        ],
    ];

    public $customer_login = [
        'phone' => [
            'rules' => "required|exact_length[10]",
            'errors' => [
                'exact_length' => 'Mobile no. must be of 10 characters.',
            ],
        ],
        'password' => [
            'rules' => 'required',
        ],
    ];

    public $add_store = [
        "name" => "required|min_length[2]",
        "gst" => "min_length[15]|max_length[15]",
        "country" => "required",
        "pincode" => "required",
        "state" => "required",
        "city" => "required",
        "account_no" => "required",
        "ifsc_code" => "required",
    ];

    public $add_store_error = [
        "name" => [
            "required" => "Please enter your store name",
            "min_length" => "Store name have to be greater than 2 characters",
        ],
        "gst" => [
            "min_length" => "Your gst no should not be less than 15 digits",
            "max_length" => "Your gst no should not be greater than 15 digits",
        ],
    ];

    public $contact_form = [
        "first_name" => "required|min_length[2]",
        "last_name" => "required|min_length[2]",
        "email" => "required",
        "phone" => "required",
        "subject" => "required|min_length[2]",
        "message" => "required|min_length[2]",
    ];

    public $contact_form_error = [
        "first_name" => [
            "min_length" => "First name  must be greater than 2 characters",
        ],
        "last_name" => [
            "min_length" => "Last name  must be greater than 2 characters",
        ],
        "subject" => [
            "min_length" => "Subject must be greater than 2 characters",
        ],
        "message" => [
            "min_length" => "Message must be greater than 2 characters",
        ],
    ];
}