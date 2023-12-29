<?php
namespace App\Models;

use CodeIgniter\Model;

class ReviewModel extends Model
{
    public function __construct()
    {
        $this->db = db_connect();
        $this->builder = $this->db->table('product_rating');
    }

    public function getReviews()
    {
        $this->builder->select('product_rating.*, product_rating.id as id, u.id as uid, u.full_name, pi.product_id, pi.product_image')
            ->join('users as u', 'product_rating.user_id=u.id', 'left')
            ->join('product_images as pi', 'product_rating.product_id=pi.product_id', 'left')
            ->where('is_default', 1)
            ->where('rating_rate!=0');
        return $this->builder->get()->getResult();
    }

    public function getProductRatingImages($id)
    {
        return $this->db->table('product_rating_images')->select('*')
            ->where("rating_id", $id)
            ->get()->getResult();
    }
}