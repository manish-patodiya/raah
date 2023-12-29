<?php

namespace App\Controllers;

class Products extends BaseController
{
    public function __construct()
    {
        $this->ProductModel = model('ProductModel');
        $this->AttributeModel = model('AttributeModel');
        $this->OrderModel = model('OrderModel');
    }

    public function index()
    {
        $request_data = $this->request->getGet();
        $filters = $request_data;
        if (isset($filters['wishlist'])) {
            if ($this->session->get('customer_info')) {
                $user_id = $this->session->get('customer_info')['user_id'];
                $filters['user_id'] = $user_id;
                $this->session->remove(['redirect_url']);
            } else {
                return $this->_check_user_login();
            }
        }
        $data = [
            'request_data' => $request_data,
            'count' => $this->ProductModel->getProductCount($filters),

            //Template loader
            "content" => "product_list",
            "data" => [
                'prod_count' => $this->ProductModel->getProductCount($request_data),
            ],
            "assets" => [
                "css" => [
                    "https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.1/css/ion.rangeSlider.min.css",
                    "public/assets/vendor_plugins/bootstrap-slider/slider.css",
                ],
                "js" => [
                    "https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.1/js/ion.rangeSlider.min.js",
                    "public/frontend/custom/js/nav_category.js",
                    "public/frontend/custom/js/products.js",
                    "public/assets/vendor_components/pagination/jquery.twbsPagination.min.js",
                    "public/assets/vendor_plugins/bootstrap-slider/bootstrap-slider.js",
                ],
            ],
        ];
        return view('frontend/template', $data);
    }

    public function search()
    {
        // if wishlist is in query string than we need a user_id for showing user's wishlish
        $request_data = $this->request->getGet();
        if (isset($request_data['wishlist']) && $request_data['wishlist']) {
            if ($this->session->get('customer_info')) {
                $user_id = $this->session->get('customer_info')['user_id'];
                $request_data['user_id'] = $user_id;
            } else {
                json_response(0, 'Customer is not login, Please login and try again!');
                die;
            }
        }

        // get all products
        $products = $this->ProductModel->getProducts($request_data);

        // format price and calculate final price and parallelly in this loop we get all the product ids of all product
        $ids_arr = [];
        foreach ($products as $k => $v) {
            $ids_arr[] = $v->id;
            $mrp = str_replace(',', '', $v->mrp);
            $products[$k]->mrp = fmt_amt($mrp);
            $products[$k]->sale_price = fmt_amt($v->sale_price);
        }

        // make two arrays of product ids first for cart product and second for wishlist products
        $cart_products = [];
        $wishlist_products = [];
        if ($this->session->get('is_customer')) {
            $user_id = $this->session->get('customer_info')['user_id'];

            // make a array of product ids which is available in cart so that we can manage frontend with go to cart or add to cart button
            $cart_details = $this->ProductModel->get_product_id_in_cart($user_id);
            foreach ($cart_details as $v) {
                $cart_products[] = $v->product_id;
            }

            // make a array of product ids  which is available in users wishlist so that we can show on frontenc which prodct is available in wishlist
            if (isset($request_data['wishlist']) && $request_data['wishlist']) {
                $wishlist_products = $ids_arr;
            } else {
                $wish_details = $this->ProductModel->get_product_id_in_wishlist($user_id);
                foreach ($wish_details as $v) {
                    $wishlist_products[] = $v->product_id;
                }
            }
        }

        $count = $this->ProductModel->getProductCount($request_data);
        $per_page = $this->ProductModel->get_product_settings()->per_page_web;
        $page_count = ceil($count / $per_page);

        // data send as a response
        $data = [
            "products" => $products,
            'cart_products' => $cart_products,
            'wishlist_products' => $wishlist_products,
            'page_count' => $page_count,
            'total_product_count' => $count,
        ];
        json_response(1, "Fetched successful", $data);
    }

    public function search_filter()
    {
        $request_data = $this->request->getGet();
        if (isset($request_data['wishlist']) && $request_data['wishlist']) {
            if ($this->session->get('customer_info')) {
                $user_id = $this->session->get('customer_info')['user_id'];
                $request_data['user_id'] = $user_id;
            } else {
                json_response(0, 'Customer is not login, Please login and try again!');
                die;
            }
        }
        // make array of attributes with there values for showing in filters at the front end
        $attributes = [];
        $product_meta = $this->ProductModel->getMetaData($request_data);
        foreach ($product_meta as $meta) {
            $attributes[$meta->label][$meta->value] = $meta->value_id;
        }

        // get extra filter of price, discount and rating
        $extra_filters = $this->ProductModel->getExtraFilters($request_data);

        // return response
        $data = [
            'attributes' => $attributes,
            'fixed_filters' => $extra_filters,
        ];
        json_response(1, 'Fetched Successfully', $data);
    }

    public function product_detail($slug)
    {
        $details = $this->ProductModel->getProduct('', $slug);
        $prod_id = $details->id;
        if ($details) {
            $prod_data = [
                "user_id" => isset($this->session->get('customer_info')['user_id']) ? $this->session->get('customer_info')['user_id'] : "",
                "product" => $details,
                "product_images" => $this->ProductModel->get_multiple_product_images($prod_id, '200X200'),
            ];

            $mrp = str_replace(array(','), '', $details->mrp);
            $discount_price = get_discount_by_percentage($mrp, $details->discount);
            if ($details->discount != 0) {
                $prod_data["sale_price"] = $mrp - $discount_price;
            } else {
                $prod_data["sale_price"] = $mrp;
            }

            $prod_data["general_info"] = $this->ProductModel->getProperties($prod_id);

            $prod_data['all_ratings'] = $this->ProductModel->getDiffRatings($prod_id);

            $prod_data['last_month_reviews'] = $this->ProductModel->get_last_month_ratings($prod_id);

            $prod_data['reviews_count'] = $this->ProductModel->get_reviews_count($prod_id);

            // check product is existing in cart or not
            if ($this->session->get('is_customer')) {
                $user_id = $this->session->get('customer_info')['user_id'];
                $prod_data['exist_in_cart'] = $this->ProductModel->check_product_existance_in_cart($prod_id, $user_id);
                $prod_data['exist_in_wishlist'] = $this->ProductModel->check_product_existance_in_wishlist($prod_id, $user_id);
            } else {
                $prod_data['exist_in_cart'] = $prod_data['exist_in_wishlist'] = 0;
            }
            $data = [
                //Template loader
                "content" => "product_details",
                "details" => $prod_data,
                "assets" => [
                    "js" => [
                        "public/assets/vendor_components/progressbar.js-master/dist/progressbar.js",
                        "public/frontend/custom/js/product_details.js",
                    ],
                ],
            ];
            // prd($data["details"]);
            return view('frontend/template', $data);
        } else {
            return view('frontend/errors/500');
        }
    }

    public function update_wishlist()
    {
        if ($this->session->get('customer_info')) {
            $prod_id = $this->request->getGet('prod_id');
            $user_id = $this->session->get('customer_info')['user_id'];
            $is_exist = $this->ProductModel->check_product_existance_in_wishlist($prod_id, $user_id);
            if ($is_exist) {
                $result = $this->ProductModel->remove_product_from_wishlist($prod_id, $user_id);
                if ($result) {
                    echo json_encode([
                        "status" => 2,
                        "msg" => "Product remove form wishlist.",
                    ]);
                }
            } else {
                $result = $this->ProductModel->add_product_in_wishlist($prod_id, $user_id);
                if ($result) {
                    echo json_encode([
                        "status" => 1,
                        'msg' => "Product added in wishlist",
                    ]);
                }
            }
        } else {
            echo json_response(0, 'Customer is not login. Please login and try again.');
        }
    }

    public function update_wishlist_with_login()
    {
        if ($this->session->get('customer_info')) {
            $this->session->remove(['redirect_url']);
        } else {
            $product_url = $this->session->get('_ci_previous_url');
            $this->session->set('product_url', $product_url);
            return $this->_check_user_login();
        }

        $prod_id = $this->request->getGet('prod_id');
        $user_id = $this->session->get('customer_info')['user_id'];
        $is_exist = $this->ProductModel->check_product_existance_in_wishlist($prod_id, $user_id);
        if (!$is_exist) {
            $this->ProductModel->add_product_in_wishlist($prod_id, $user_id);
        }
        $url = $this->session->get('product_url');
        $this->session->remove(['product_url', 'redirect_url']);
        return redirect()->to($url);
    }

    //......
    public function product_cart()
    {

        if ($this->session->get('customer_info')) {
            $this->session->remove(['redirect_url']);
        } else {
            return $this->_check_user_login();
        }

        $data = [
            "header" => "header_bottom",
            "content" => "product_cart",
            "assets" => [
                "js" => [
                    "public/frontend/custom/js/product_cart.js",
                    "public/assets/vendor_components/sweetalert/sweetalert.min.js",
                ],
                "css" => [
                    "public/frontend/custom/css/pro_cart.css",
                    "public/assets/vendor_components/sweetalert/sweetalert.css",
                ],
            ],
        ];
        return view('frontend/template', $data);
    }

    public function add_to_cart()
    {
        $post_data = $this->request->getGet();
        if ($this->session->get('is_customer')) {
            $user_id = $this->session->get('customer_info')['user_id'];
            if (!$this->ProductModel->check_product_existance_in_cart($post_data['prod_id'], $user_id)) {
                $data = array(
                    'user_id' => $user_id,
                    'product_id' => $post_data['prod_id'],
                );
                $ins_id = $this->ProductModel->add_in_cart($data);
                $count = $this->_update_session_cart_count();
                json_response(1, 'Product successfully added in you cart', ['count' => $count]);
            } else {
                json_response(2, 'Product is already exist in your cart');
            }
        } else {
            json_response(0, 'Customer is not login. Please login and try again.');
        }
    }

    public function update_cart_with_login()
    {

        if ($this->session->get('customer_info')) {
            $this->session->remove(['redirect_url']);
        } else {
            $product_url = $this->session->get('_ci_previous_url');
            $this->session->set('product_url', $product_url);
            return $this->_check_user_login();
        }

        $user_id = $this->session->get('customer_info')['user_id'];
        $get_data = $this->request->getGet();
        if (!$this->ProductModel->check_product_existance_in_cart($get_data['prod_id'], $user_id)) {
            $data = array(
                'user_id' => $user_id,
                'product_id' => $get_data['prod_id'],
            );
            $ins_id = $this->ProductModel->add_in_cart($data);
        }
        $url = $this->session->get('product_url');
        $this->session->remove(['product_url', 'redirect_url']);
        return redirect()->to($url);
    }

    public function get_cart_details()
    {
        $uid = $this->session->get('customer_info')['customer_id'];
        $product_cart_details = $this->ProductModel->getProductCartDetails($uid);

        foreach ($product_cart_details as $k => $v) {
            $sale_price_amt = $v->mrp * $v->quantity;
            $per = $v->discount;
            $total_dis = get_discount_by_percentage($sale_price_amt, $per);
            $total_amt = $sale_price_amt - $total_dis;

            $product_cart_details[$k]->total_dis = $total_dis;
            $product_cart_details[$k]->sale_price_amt = $sale_price_amt;
            $product_cart_details[$k]->total_amt = $total_amt;
        };

        echo json_encode([
            "status" => 1,
            "product_cart_details" => $product_cart_details,
        ]);
    }

    public function remove_product_cart()
    {
        $post_data = $this->request->getGet();
        $pro_cart_id = $post_data['pro_cart_id'];
        $res = $this->ProductModel->remove_pro_cart_deleteRow($pro_cart_id);
        $count = $this->_update_session_cart_count();
        if ($res) {
            json_response(1, "Product removed successfully.", ['count' => $count]);
        }
    }

    public function update_cart()
    {
        $post_data = $this->request->getGet();
        $data = array(
            'quantity' => $post_data['quantity'],
        );
        $res = $this->ProductModel->updateRow_product_cart($data, $post_data);

        if ($res) {
            echo json_encode([
                "status" => 1,
                // 'msg' => 'Youve changed CoupleHub Graphic Print Couple Round Neck Dark Green T-Shirt QUANTITY to 3',
            ]);
        }
    }

    private function _update_session_cart_count()
    {
        // update session cart count
        $customer_info = $this->session->get('customer_info');
        $count = 0;
        if ($customer_info) {
            $count = $this->ProductModel->get_cart_products_count($customer_info['customer_id']);
            $customer_info['cart_count'] = $count;
            $this->session->set('customer_info', $customer_info);
        }
        return $count;
    }

    public function make_payment()
    {
        if ($this->session->get('customer_info')) {
            $this->session->remove(['redirect_url']);
        } else {
            return $this->_check_user_login();
        }

        $order_id = $this->request->getGet('order_id');

        // get all products
        $details = $this->OrderModel->getOrderProductsByTransactionID($order_id);

        // check product availiblity
        if (!$details) {
            return view('frontend/errors/500');
        }

        $grand_total = 0;
        foreach ($details as $k => $v) {

            // get total discount
            $total_dis = get_discount_by_percentage($v->mrp, $v->discount); //single product discount
            $details[$k]->total_dis = $total_dis * $v->quantity; // totol discount

            // get total amount
            $total_amt = $v->mrp - $total_dis; // single product amount
            $details[$k]->total_amt = $total_amt * $v->quantity; // total amount

            // calculate grand total (payable amt)
            $grand_total += $total_amt * $v->quantity;
        };

        $data = [
            "header" => "header_bottom",
            "content" => "payment/make_payment",
            "assets" => [
                "js" => [
                    "public/frontend/custom/js/payment.js",
                ],
                "css" => [],
            ],
            "data" => [
                'list' => $details,
                'grand_total' => $grand_total,
                'order_id' => $order_id,
            ],
        ];
        return view('frontend/template', $data);
    }

    public function create_order()
    {
        $cuid = $this->session->get('customer_info')['customer_id'];
        if (!$cuid) {
            json_response('0', "Customer is not login.");
        }

        // get all cart products
        $details = $this->ProductModel->getProductCartDetails($cuid);
        $grand_total = 0;
        foreach ($details as $k => $v) {

            // get total discount
            $total_dis = get_discount_by_percentage($v->mrp, $v->discount); //single product discount
            $details[$k]->total_dis = $total_dis * $v->quantity; // totol discount

            // get total amount
            $total_amt = $v->mrp - $total_dis; // single product amount
            $details[$k]->total_amt = $total_amt * $v->quantity; // total amount

            // calculate grand total (payable amt)
            $grand_total += $total_amt * $v->quantity;
        };

        // make order details data
        $order_details = [
            'grand_total' => $grand_total,
            'customer_id' => $cuid,
            'products_details' => $details,
        ];

        // Add order in databse
        $order_id = $this->OrderModel->addOrder($order_details);

        if ($order_id) {
            json_response(1, "Order create succesfully", ['order_id' => $order_id]);
        } else {
            json_response(1, "Something went wrong.");
        }
    }

    public function cancel_payment()
    {
        $order_id = $this->request->getPost('order_id');
        $this->OrderModel->deleteOrder($order_id);
        return redirect()->to(base_url('cart'));
    }

    public function payment_success()
    {
        $cust_id = $this->session->get('customer_info')['customer_id'];
        $post_data = $this->request->getPost();

        // validate url
        if (!isset($post_data['order_id']) || !$post_data['order_id'] || !isset($post_data['payment_id']) || !$post_data['payment_id']) {
            return view('frontend/errors/500');
        } else {
            // check payment by payment id
            $client = service('curlrequest');
            $response = $client->request('GET', 'https://api.razorpay.com/v1/payments/' . $post_data['payment_id'], [
                'auth' => ['rzp_test_Fou50mEQERxqwz', 'wGNjuxPCuXRbrCzjmxjvDvh2'],
            ]);
            $status = $response->getStatusCode();
            if ($status != 200) {
                return view('frontend/errors/500');
            }
        }

        // update status
        $res = $this->OrderModel->updateOrderStatus(2, $post_data['order_id']);

        // add row in order payment table
        $res = $this->OrderModel->insertPayment($post_data);

        // empty customer cart
        $res = $this->ProductModel->emptyCart($cust_id);
        $this->_update_session_cart_count();

        $data = [
            "header" => "header_bottom",
            "content" => "payment/payment_success",
            "assets" => [
                "js" => [],
                "css" => [],
            ],
            "data" => [],
        ];
        return view('frontend/template', $data);
    }

    public function autosuggest()
    {
        $text = $this->request->getGet('text');
        $res = $this->ProductModel->autosuggest($text);
        echo json_encode([
            'keywords' => $res,
        ]);
    }

    public function rating_review_product()
    {
        if ($this->session->get('customer_info')) {
            $this->session->remove(['redirect_url']);
        } else {
            return $this->_check_user_login();
        }
        $prod_id = $this->request->getGet('pid');
        $details = $this->ProductModel->getProduct($prod_id);
        $prod_data = [
            "product" => $details,
            "reviews_count" => $this->ProductModel->get_reviews_count($prod_id),
        ];
        $data = [
            //Template loader
            "content" => "rating_review_product",
            "details" => $prod_data,
            "assets" => [
                "js" => [
                    "public/assets/vendor_components/raty-master/lib/jquery.raty.js",
                    "public/frontend/custom/js/rating_review_product.js",
                ],
            ],
        ];
        return view('frontend/template', $data);
    }

    private function _check_user_login()
    {
        $redirect_url = current_url() . '?' . $_SERVER['QUERY_STRING'];
        $this->session->set('redirect_url', $redirect_url);
        $this->session->markAsFlashdata('redirect_url');
        return redirect()->to(base_url('customer'));
    }

    public function add_rate_and_review()
    {
        $post_data = $this->request->getPost();
        if ($this->session->get('customer_info') && trim($post_data['description'])) {
            $prod_id = $post_data['pid'];
            $data = [
                'user_id' => $this->session->get('customer_info')['user_id'],
                'product_id' => $prod_id,
                'rating_rate' => $post_data['score'],
                'description' => $post_data['description'],
                'title' => $post_data['title'],
                'created_at' => date("y-m-d"),
            ];
            $product_rating_id = $this->ProductModel->setRating($data);

            if (isset($post_data['rating_img'])) {
                $data1 = [];
                foreach ($post_data['rating_img'] as $key => $value) {
                    $data1[] = [
                        'product_id' => $prod_id,
                        "rating_id" => $product_rating_id,
                        "images" => base_url("public/uploads/product_images/$value"),
                    ];
                }
                $rating = $this->ProductModel->add_rating_images($data1);
            }
            if ($product_rating_id) {
                echo json_encode([
                    "status" => 1,
                    "msg" => "Thank you so much. Your review has been saved.",
                ]);
            }
        } else {
            echo json_encode([
                'status' => 0,
                "msg" => "Please login first.",
            ]);
        }
    }

    public function upload_rating_img()
    {
        $file = $this->request->getFile('image');
        if ($file->isValid()) {
            $upload_path = './public/uploads/product_images/';
            $name = $file->getRandomName();
            $res = $file->move($upload_path, $name);
        }
        $this->_resize_image($upload_path . $name, $name);
        echo json_encode([
            "status" => 1,
            'rating_img' => $name,
        ]);
    }

    public function _resize_image($xfile, $name)
    {
        $upload_path = "./public/uploads/product_images/";

        foreach (IMAGE_SIZES as $key => $value) {
            $image = \Config\Services::image()
                ->withFile($xfile)
                ->resize($key, $key, true, 'height')
                ->save($upload_path . $value . '/' . $name);
        }
    }

    public function all_review_product()
    {
        $prod_id = $this->request->getGet('pid');
        $prod_data["product_id"] = $prod_id;
        $per_page_limit = 10;
        $prod_data['product_data'] = $this->ProductModel->getProduct($prod_id);

        $prod_data['all_ratings'] = $this->ProductModel->getDiffRatings($prod_id);

        $reviews_count = $this->ProductModel->get_reviews_count($prod_id);
        $prod_data['page_count'] = ceil($reviews_count->count / $per_page_limit);

        //get all images for product rating table
        $prod_data['img'] = $this->ProductModel->get_all_images_product_rating($prod_id);

        $data = [
            //Template loader
            "content" => "review_product",
            "details" => $prod_data,
            "assets" => [
                "js" => [
                    "public/assets/vendor_components/pagination/jquery.twbsPagination.min.js",
                    "public/assets/vendor_components/progressbar.js-master/dist/progressbar.js",
                    "public/frontend/custom/js/review_product.js",
                ],
            ],
        ];
        return view('frontend/template', $data);
    }

    public function get_all_review_product_details()
    {

        $post_data = $this->request->getPost();

        $all_ratings_view = $this->ProductModel->view_rating_product_img($post_data);

        if ($all_ratings_view) {
            echo json_encode([
                "status" => 1,
                "data" => $all_ratings_view,
            ]);
        } else {
            echo json_encode([
                'status' => 0,
                "msg" => "",
            ]);
        }
    }
}