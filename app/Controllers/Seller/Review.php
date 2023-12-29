<?php
namespace App\Controllers\Seller;

use App\Controllers\Seller\SellerController;

class Review extends SellerController
{
    public function __construct()
    {
        check_seller_login();
        $this->ReviewModel = model('ReviewModel');
    }

    public function index()
    {
        $data = [
            'session' => $this->session,
            // 'review' => $this->ReviewModel->getReviews(),
        ];
        // prd($data['review']);
        return view("seller/review/review", $data);
    }

    public function datatable_json()
    {
        $review = $this->ReviewModel->getReviews();
        // prd($review);
        $arr = [];
        foreach ($review as $k => $v) {
            $product_rating_images = $this->ReviewModel->getProductRatingImages($v->id);
            $rating_img = '';
            $order_date = date("d M Y", strtotime($v->created_at));
            foreach ($product_rating_images as $key => $value) {
                $url = $value->images != "" ? $value->images : base_url('/public/uploads/image_found/no-image.jpg');
                $rating_img .= '<img src="' . $url . '" style="width:30px;margin-right:10px;">';
            }
            $img_url = $v->product_image != "" && file_exists("public/uploads/product_images/" . $v->product_image) ? base_url("/public/uploads/product_images/" . $v->product_image) : base_url('/public/uploads/image_found/no-image.jpg');
            $product_img = '<img src="' . $img_url . '" style="width:50px;">';
            $action = '<a title="Edit" class="text-warning sup_update me-1" href="#" unit_id="' . $v->id . '" style="font-size: 1.2rem;"> <i class="fa fa-pencil-square-o"></i></a><a title="Delete" class="text-danger sup_delete me-1"  uid="' . $v->id . '" href="#" title="Delete"  style="font-size: 1.2rem;"> <i class="fa fa-trash-o"></i></a>';
            $review = "<small class='badge badge-pill badge-success'>" . to_fixed($v->rating_rate, 1)
            . "<i class='mdi mdi-star'></i></small><br><small>" . $v->description . "</small>";
            $arr[] = [
                $product_img,
                $v->full_name,
                $review,
                $rating_img,
                $order_date,

            ];
        }
        echo json_encode([
            "status" => 1,
            "details" => $arr,
        ]);
    }
}