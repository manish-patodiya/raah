<?php

namespace App\Models\product_models;

use App\Libraries\Generateqr;
use CodeIgniter\Model;

class productModel extends Model
{
    public $builder;
    public $db;
    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->session->start();

        $this->db = db_connect();
        $this->builder = $this->db->table('products');
        $this->product_images = $this->db->table('product_images');
        $this->products_wishlist = $this->db->table('products_wishlist');
        $this->predictive_searches = $this->db->table('predictive_searches');
        $this->product_cart_details = $this->db->table('product_cart_details');
        $this->product_meta = $this->db->table('product_meta');
    }

    public function createProduct($post_data, $user_id = false)
    {
        // prd($post_data);
        if ($post_data['predictive_search']) {
            $predictive_search = explode(",", $post_data['predictive_search']);
            $result = $this->get_predictive_search_keyword($post_data['title']);
            $new_predictive_keywords = [];
            $data = [];
            if (!$result) {
                $new_predictive_keywords = ["keyword" => $post_data["title"]];
                $data = [$new_predictive_keywords];
            }
            foreach ($predictive_search as $key => $value) {
                $result = $this->get_predictive_search_keyword($value);
                if (!$result) {
                    $new_predictive_keywords["keyword"] = $value;
                    $data[] = $new_predictive_keywords;
                }
            }
            if ($data) {
                $result = $this->insert_predictive_searches($data);
            }
        }

        $price = str_replace([',', ' '], ['', ''], $post_data["mrp"]);
        $data = array(
            'user_id' => $user_id,
            "title" => format_name($post_data['title']),
            "catalog_file" => isset($post_data['catalog_file']) ?: '',
            "category_id" => $post_data['category_id'],
            "hsn_code" => $post_data['hsn_code'],
            "gst_rate" => $post_data['gst_rate'],
            "mrp" => $price,
            "discount" => $post_data["discount"],
            "sale_price" => round($price - ($price * $post_data["discount"] / 100)),
            "key_highlights" => format_name($post_data["key_highlights"]),
            "product_details" => format_name($post_data['pro_details']),
            "predictive_search" => $post_data['predictive_search'],
            "quantity" => $post_data['quantity'],
            "net_weight" => $post_data['net_weight'],
            "country_of_origin" => $post_data['country_of_origin'],
            "brand_id" => isset($post_data["brand"]),
            "status" => $post_data['status'],
            "updated_at" => date('Y-m-d'),
            "created_at" => date('Y-m-d'),
        );
        $this->builder->insert($data);
        $id = $this->db->insertID();

        //Product created. lets update the product public url (slug)
        $slug = $this->_update_product_slug($id, $post_data['title'], $id);

        // lets create and qr and update along with product
        $this->_update_product_qr($id, $slug);

        return $id;
    }

    private function _update_product_slug($id, $title)
    {
        $slug = create_slug("$id-$title");
        $this->builder->set([
            "slug" => $slug,
        ])->where('id', $id)->update();
        return $slug;
    }

    private function _update_product_qr($id, $slug)
    {
        $qr_img = $this->_generate_product_qr($id, $slug);
        return $this->builder->set(["qr_code_img" => $qr_img])->where(['id' => $id])->update();
    }

    private function _generate_product_qr($id, $slug)
    {
        $qr = new Generateqr;
        $result = $qr->generate(base_url("products/detail/$slug"));
        if ($result) {
            $result = explode("\\", $result);
            $result = end($result);
        }
        return base_url("public/uploads/qrcodes/$result");
    }

    public function insert_batch($data)
    {
        return $this->builder->insertBatch($data);
    }

    public function getAll($catid = false, $status_id = false, $out_of_stock = false, $userid = false)
    {
        $builder = $this->builder;
        $builder->select("products.*, products.id as pid, categories.id as cid, categories.category_name,pi.product_image")
            ->join('categories', 'categories.id=products.category_id', 'left')
            ->join('product_images pi', 'pi.product_id=products.id', 'left')
            ->where("products.deleted_at is NULL")
            ->where("(is_default = 1 OR is_default is NULL) AND (type = '200X200' OR type is NULL)");
        if ($userid) {
            $builder->where("products.user_id", $userid);
        }
        if ($catid != "") {
            $builder->where("(products.category_id = $catid OR categories.pid = $catid)");
        }
        if ($status_id != "") {
            // prd($status_id);
            $builder->where('products.status', $status_id);
        }
        if ($out_of_stock != "") {
            // prd($out_of_stock);
            $builder->where('products.quantity', $out_of_stock);
        }
        $builder->orderBy('products.id', "desc");
        return $builder->get()->getResult();
    }

    public function getAllAdminProducts($catid = false, $status_id = false, $out_of_stock = false, $userid = false)
    {
        $builder = $this->builder;
        $builder->select("products.*, products.id as pid, categories.id as cid, categories.category_name,pi.product_image")
            ->join('categories', 'categories.id=products.category_id', 'left')
            ->join('product_images pi', 'pi.product_id=products.id', 'left')
            ->where("products.deleted_at is NULL")
            ->where("(is_default = 1 OR is_default is NULL) AND (type = '200X200' OR type is NULL)")
            ->where('status!=1');
        if ($userid) {
            $builder->where("products.user_id", $userid);
        }
        if ($catid != "") {
            $builder->where('products.category_id', $catid);
        }
        if ($status_id != "") {
            // prd($status_id);
            $builder->where('products.status', $status_id);
        }
        if ($out_of_stock != "") {
            // prd($out_of_stock);
            $builder->where('products.quantity', $out_of_stock);
        }
        $builder->orderBy('products.id', "desc");
        return $builder->get()->getResult();
    }

    public function updateRow($post_data)
    {
        if ($post_data['predictive_search']) {
            $predictive_search = explode(",", $post_data['predictive_search']);
            $result = $this->get_predictive_search_keyword(format_name($post_data['title']));
            $new_predictive_keywords = [];
            $keywords = [];
            if (!$result) {
                $new_predictive_keywords = ["keyword" => $post_data["title"]];
                $keywords = [$new_predictive_keywords];
            }
            foreach ($predictive_search as $key => $value) {
                $result = $this->get_predictive_search_keyword($value);
                if (!$result) {
                    $new_predictive_keywords["keyword"] = $value;
                    $keywords[] = $new_predictive_keywords;
                }
            }
            if ($keywords) {
                // prd($keywords);
                $result = $this->insert_predictive_searches($keywords);
            }
        }

        if (isset($post_data['catalog_file'])) {
            $data["catalog_file"] = $post_data['catalog_file'];
        }

        $price = str_replace([',', ' '], ['', ''], $post_data["mrp"]);
        $data = array(
            "title" => format_name($post_data['title']),
            "category_id" => $post_data['category_id'],
            "hsn_code" => $post_data['hsn_code'],
            "gst_rate" => $post_data['gst_rate'],
            "mrp" => str_replace([',', ' '], ['', ''], $post_data["mrp"]),
            "discount" => $post_data["discount"],
            "sale_price" => round($price - ($price * $post_data["discount"] / 100)),
            "key_highlights" => format_name($post_data["key_highlights"]),
            "product_details" => format_name($post_data['pro_details']),
            "predictive_search" => $post_data['predictive_search'],
            "brand_id" => isset($post_data['brand']),
            "quantity" => $post_data['quantity'],
            "net_weight" => $post_data['net_weight'],
            "country_of_origin" => $post_data["country_of_origin"],
            "status" => $post_data['status'],
            "updated_at" => date('Y-m-d'),
        );

        $builder = $this->builder;
        $builder->set($data);
        $builder->where('id', $post_data['pro_id']);
        return $builder->update();
    }

    public function get_product_by_id($id)
    {
        $builder = $this->builder;
        $builder->select("products.*,hd.hsn_code_4_digits")->where('products.id', $id)->join('hsn_details hd', 'hd.hsn_code = products.hsn_code', 'left');
        return $builder->get()->getRowArray();
        // echo $this->db->getLastQuery();die;
    }

    public function deleteRow($id)
    {
        $builder = $this->builder;
        $builder->set(['deleted_at' => date('Y-m-d')]);
        $builder->where('id', $id);
        $builder->update();
    }

    public function get_properties($cat_id)
    {
        return $this->db->table('product_label_category plc')
            ->select('plc.label_id, pl.label, pv.value, pv.id as value_id')
            ->join('product_label pl', 'pl.id=plc.label_id')
            ->join('product_value pv', 'pv.label_category_id = plc.id', 'left')
            ->where('plc.category_id', $cat_id)
            ->orderBy('plc.label_id')
            ->get()->getResult();
    }

    public function insertProperties($data)
    {
        return $this->db->table('product_meta')->insertBatch($data);
    }

    public function deleteProperites($product_id)
    {
        return $this->db->table('product_meta')->delete(['product_id' => $product_id]);
    }

    public function get_properties_of_product($product_id)
    {
        return $this->db->table('product_meta')->getWhere(['product_id' => $product_id])->getResult();
    }

    public function get_product_settings()
    {
        $res = $this->db->table('product_settings')->get()->getRow();
        if ($res) {
            return $res;
        } else {
            $obj = new \stdClass;
            $obj->per_page_web = 10;
            $obj->per_page_mobile = 10;
            $obj->max_product_limit = 10;
            $obj->max_description_text_limit = 500;
            $obj->cron_url = '';
            return $obj;
        }
        return $this->db->table('product_settings')->get()->getRow();
    }

    public function set_product_settings($data)
    {
        $res = $this->db->table('product_settings')->countAllResults();
        if ($res) {
            return $this->db->table('product_settings')->set($data)->update();
        } else {
            $this->db->table('product_settings')->insert($data);
            return $this->db->insertID();
        }
    }

    public function getProducts($filter = [])
    {
        $this->builder->select('products.*,pi.product_image')
            ->join('product_images pi', 'pi.product_id=products.id', 'left')
            ->where("(is_default = 1 OR is_default is NULL) AND (type = '200X200' OR type is NULL)")
            ->where('products.deleted_at', null)
            ->where('status=3');

        if (isset($filter['page']) && $filter['page']) {
            $per_page = $this->get_product_settings()->per_page_web;
            $this->builder->limit($per_page, (($filter['page'] * $per_page) - $per_page));
        }

        if (isset($filter['cat']) && $filter['cat']) {
            $this->builder->where('category_id', $filter['cat']);
        }

        if (isset($filter['search']) && $filter['search']) {
            $search = trim($filter['search']);
            $this->builder->where("(title LIKE '%$search%' ESCAPE '!' OR predictive_search LIKE '%$search% ESCAPE' '!')");
        }

        if (isset($filter['wishlist']) && $filter['wishlist'] && isset($filter['user_id']) && $filter['user_id']) {
            $this->builder->join('products_wishlist pw', 'products.id = pw.product_id')->where('pw.user_id', $filter['user_id']);
        }

        if (isset($filter['sort_order']) && $filter['sort_order']) {
            $arr = [1 => 'rating desc', 'sale_price asc', 'sale_price desc', 'products.id asc'];
            $this->builder->orderBy($arr[$filter['sort_order']]);
        }

        if (isset($filter['filters']) && $filter['filters']) {
            $filters = json_decode($filter['filters']);

            // filter with attributes
            if (isset($filters->attr) && $filters->attr) {
                $attrs = (array) $filters->attr;
                if (!empty($attrs)) {
                    $value_ids_arr = [];
                    foreach ($attrs as $v) {
                        $value_ids_arr[] = $v;
                    }
                    $this->builder->join('product_meta pm', 'products.id = pm.product_id')->whereIn('pm.value_id', $value_ids_arr)->groupBy('pm.product_id');
                }
            }

            // filter with price
            if (isset($filters->price) && $filters->price) {
                $min = $filters->price->min;
                $max = $filters->price->max;
                if ($min && $max) {
                    $this->builder->where("products.sale_price BETWEEN '$min' AND '$max'");
                } else if (!$min && $max) {
                    $this->builder->where("products.sale_price < '$max'");
                }
            }

            // filter with discount
            if (isset($filters->discount) && $filters->discount) {
                $min = $filters->discount->min;
                $max = $filters->discount->max;
                if ($min && $max) {
                    $this->builder->where("products.discount BETWEEN '$min' AND '$max'");
                } else if (!$min && $max) {
                    $this->builder->where("products.discount <= '$max'");
                }
            }

            // filter with rating
            if (isset($filters->rating)) {
                if ($filters->rating == 0) {
                    $this->builder->where("products.rating", 0);
                } else if ($filters->rating > 0) {
                    $this->builder->where("products.rating >= '$filters->rating'");
                }
            }
        }

        $this->builder->orderBy("products.id", "desc");
        $res = $this->builder->get()->getResult();
        // prd($this->db->getLastQuery()->getQuery());
        return $res;
    }

    public function getMetaData($filter)
    {
        $this->builder->select('pm.label_id,label,pm.value_id,value')
            ->join('product_meta pm', 'pm.product_id = products.id')
            ->join('product_label pl', 'pm.label_id = pl.id')
            ->join('product_value pv', 'pm.value_id = pv.id')
            ->groupBy('pm.value_id')
            ->where('pm.value_id > 0')
            ->where('status=3');;

        if (isset($filter['cat']) && $filter['cat']) {
            $this->builder->where('category_id', $filter['cat']);
        }

        if (isset($filter['search']) && $filter['search']) {
            $search = trim($filter['search']);
            $this->builder->where("(title LIKE '%$search%' ESCAPE '!' OR predictive_search LIKE '%$search% ESCAPE' '!')");
        }

        if (isset($filter['wishlist']) && $filter['wishlist'] && isset($filter['user_id']) && $filter['user_id']) {
            $this->builder->join('products_wishlist pw', 'products.id = pw.product_id')->where('pw.user_id', $filter['user_id']);
        }

        return $res = $this->builder->get()->getResult();
    }

    public function getExtraFilters($filter)
    {
        $this->builder->select('MAX(sale_price) as max_price, MIN(sale_price) as min_price,MIN(discount) as min_dis,MAX(discount) as max_dis,MIN(rating) as min_rating,MAX(rating) max_rating')->where('deleted_at', null)->where('status=3');;

        if (isset($filter['cat']) && $filter['cat']) {
            $this->builder->where('category_id', $filter['cat']);
        }

        if (isset($filter['search']) && $filter['search']) {
            $search = trim($filter['search']);
            $this->builder->where("(title LIKE '%$search%' ESCAPE '!' OR predictive_search LIKE '%$search% ESCAPE' '!')");
        }

        if (isset($filter['wishlist']) && $filter['wishlist'] && isset($filter['user_id']) && $filter['user_id']) {
            $this->builder->join('products_wishlist pw', 'products.id = pw.product_id')->where('pw.user_id', $filter['user_id']);
        }

        $res = $this->builder->get()->getRow();
        $data = [
            'price' => ["min" => round($res->min_price), "max" => round($res->max_price)],
            'disc' => ["min" => $res->min_dis, "max" => $res->max_dis],
            'rating' => ["min" => $res->min_rating, "max" => $res->max_rating],
        ];
        return $data;
    }

    public function getProduct($product_id, $slug = '')
    {
        $this->builder->select('products.*,products.id as id, pm.id as pm_id, pl.id as pl_id, pv.id as pv_id,pi.product_image')
            ->join('product_meta pm', 'pm.product_id=products.id', 'left')
            ->join('product_images pi', 'pi.product_id=products.id', 'left')
            ->join('product_label pl', 'pl.id=pm.label_id', 'left')
            ->join('product_value pv', 'pv.id=pm.value_id', 'left')
            ->where("(is_default = 1 OR is_default is NULL) AND (type = '200X200' OR type is NULL)");

        if ($product_id) {
            $this->builder->where(["products.id" => $product_id]);
        } else {
            $this->builder->where(["products.slug" => $slug]);
        }
        return $this->builder->get()->getRow();
    }

    public function getProductCount($filter = [])
    {
        if (isset($filter['cat']) && $filter['cat']) {
            $this->builder->where('category_id', $filter['cat']);
        }
        if (isset($filter['search']) && $filter['search']) {
            $search = trim($filter['search']);
            $this->builder->where("(title LIKE '%$search%' ESCAPE '!' OR predictive_search LIKE '%$search% ESCAPE' '!')");
        }
        if (isset($filter['wishlist']) && $filter['wishlist'] && isset($filter['user_id']) && $filter['user_id']) {
            $this->builder->join('products_wishlist pw', 'products.id = pw.product_id')->where('pw.user_id', $filter['user_id']);
        }

        if (isset($filter['filters']) && $filter['filters']) {
            $filters = json_decode($filter['filters']);

            // filter with attributes
            if (isset($filters->attr) && $filters->attr) {
                $attrs = (array) $filters->attr;
                if (!empty($attrs)) {
                    $value_ids_arr = [];
                    foreach ($attrs as $v) {
                        $value_ids_arr[] = $v;
                    }
                    $this->builder->join('product_meta pm', 'products.id = pm.product_id')->whereIn('pm.value_id', $value_ids_arr)->groupBy('pm.product_id');
                }
            }

            // filter with price
            if (isset($filters->price) && $filters->price) {
                $min = $filters->price->min;
                $max = $filters->price->max;
                if ($min && $max) {
                    $this->builder->where("products.sale_price BETWEEN '$min' AND '$max'");
                } else if (!$min && $max) {
                    $this->builder->where("products.sale_price < '$max'");
                }
            }

            // filter with discount
            if (isset($filters->discount) && $filters->discount) {
                $min = $filters->discount->min;
                $max = $filters->discount->max;
                if ($min && $max) {
                    $this->builder->where("products.discount BETWEEN '$min' AND '$max'");
                } else if (!$min && $max) {
                    $this->builder->where("products.discount <= '$max'");
                }
            }

            // filter with rating
            if (isset($filters->rating)) {
                if ($filters->rating == 0) {
                    $this->builder->where("products.rating", 0);
                } else if ($filters->rating > 0) {
                    $this->builder->where("products.rating >= '$filters->rating'");
                }
            }
        }

        return $this->builder->select('products.id')->where('deleted_at', null)->where('status=3')->countAllResults();
        // prd($this->db->getLastQuery()->getQuery());
    }

    public function autosuggest($text)
    {
        return $this->db->table('predictive_searches')->like('keyword', $text)->groupBy('keyword')->limit(10)->get()->getResult();
        // prd($this->db->getLastQuery()->getQuery());
    }

    // product images table functionality
    public function add_product_images($data)
    {
        $res = $this->product_images->insertBatch($data);
        return $this->db->insertID();
    }

    //Update single product image in database
    public function add_product_image($data)
    {
        $this->product_images->insert($data);
        return $this->db->insertID();
    }

    public function update_product_image($data, $id)
    {
        $this->product_images->set($data)
            ->where('product_id', $id)
            ->where('is_default', 1)
            ->update();
    }

    public function get_multiple_product_images($id, $type)
    {
        $this->product_images->select('*')
            ->where('product_id', $id)
            ->where('type', $type);
        return $this->product_images->get()->getResult();
    }

    public function getDefaultImgURL($id, $type)
    {
        $this->product_images->select('*')
            ->where('product_id', $id)
            ->where('is_default', 1)
            ->where('type', $type);
        $res = $this->product_images->get()->getRow();
        return $res ? $res->product_image : '';
    }

    public function remove_product_image_by_id($id)
    {
        return $this->product_images->where('id', $id)->orWhere('pid', $id)->delete();
    }

    public function count_product_images($prod_id)
    {
        return $this->product_images->where(["product_id" => $prod_id, "pid" => 0])->countAllResults();
        // prd($this->db->getLastQuery()->getQuery());
    }

    public function make_default_image($img_id, $prod_id)
    {
        // set is_default is 0 for all images
        $this->product_images->where('product_id', $prod_id)->set('is_default', 0)->update();

        // now update default image
        return $this->product_images->where('id', $img_id)->orWhere('pid', $img_id)->set('is_default', 1)->update();
    }

    // wishlist table functionality

    public function check_product_existance_in_wishlist($prod_id, $user_id)
    {
        return $this->products_wishlist->where(['user_id' => $user_id, 'product_id' => $prod_id])->countAllResults();
    }

    public function get_product_id_in_wishlist($user_id)
    {
        return $this->products_wishlist->where('user_id', $user_id)->get()->getResult();
    }

    public function add_product_in_wishlist($prod_id, $user_id)
    {
        $this->products_wishlist->insert([
            "product_id" => $prod_id,
            "user_id" => $user_id,
        ]);
        return $this->db->insertID();
    }

    public function remove_product_from_wishlist($prod_id, $user_id)
    {
        $builder = $this->products_wishlist;
        $builder->where('product_id', $prod_id)
            ->where('user_id', $user_id);
        $builder->delete();
        return $this->db->affectedRows();
    }

    // predictive search table functionalty

    public function get_predictive_search_keyword($keyword)
    {
        $this->predictive_searches->select('*')
            ->where('keyword', $keyword);
        return $this->predictive_searches->get()->getResult();
    }

    public function insert_predictive_searches($data)
    {
        $this->predictive_searches->insertBatch($data);
        return $this->db->insertID();
    }

    ///cart functionality
    public function add_in_cart($data)
    {
        $product_cart_details = $this->product_cart_details;
        $data1 = [
            "updated_at" => date('Y-m-d'),
            "created_at" => date('Y-m-d'),
        ];
        $data = array_merge($data, $data1);
        $product_cart_details->insert($data);
        return $this->db->insertID();
    }

    public function get_product_id_in_cart($user_id)
    {
        return $this->product_cart_details->where('user_id', $user_id)->get()->getResult();
    }

    public function check_product_existance_in_cart($prod_id, $user_id)
    {
        return $this->product_cart_details->where(['user_id' => $user_id, 'product_id' => $prod_id])->countAllResults();
    }

    public function get_cart_products_count($user_id)
    {
        return $this->product_cart_details->where(['user_id' => $user_id])->countAllResults();
    }

    public function getProductCartDetails($uid)
    {
        $this->product_cart_details->select('p.slug, p.title, p.discount, p.mrp, p.sale_price, p.id as product_id, product_cart_details.quantity, product_cart_details.user_id, product_cart_details.id as pro_cart_id, pi.product_image, u.full_name as seller_name, u.id as seller_id, sd.name as store_name')
            ->join('products p', 'p.id=product_cart_details.product_id')
            ->join('product_images pi', 'pi.product_id=p.id', 'left')
            ->join('users u', 'u.id=p.user_id')
            ->join('store_details sd', 'sd.user_id=p.user_id')
            ->where("(is_default = 1 OR is_default is NULL) AND (type = '200X200' OR type is NULL)")
            ->where('product_cart_details.user_id', $uid);
        return $this->product_cart_details->get()->getResult();
    }

    public function remove_pro_cart_deleteRow($id)
    {
        $pro_cart = $this->product_cart_details;
        $pro_cart->where('id', $id);
        return $pro_cart->delete();
    }

    public function emptyCart($user_id)
    {
        return $this->product_cart_details->where('user_id', $user_id)->delete();
    }

    public function updateRow_product_cart($data, $post_data)
    {
        $data1 = [
            "updated_at" => date('Y-m-d'),
        ];
        $data = array_merge($data, $data1);
        $pro_cart = $this->product_cart_details;
        $pro_cart->set($data);
        $pro_cart_id = $post_data['pro_cart_id'];
        $product_id = $post_data['product_id'];

        $pro_cart->where('id', $pro_cart_id);
        $pro_cart->where('product_id', $product_id);

        return $pro_cart->update();
    }

    // product details functionality
    public function getProperties($id)
    {
        $this->product_meta->select('*')
            ->join('product_label pl', 'pl.id=product_meta.label_id')
            ->join('product_value pv', 'pv.id=product_meta.value_id')
            ->where('product_meta.product_id', $id);
        return $this->product_meta->get()->getResult();
    }

    public function setRating($data)
    {
        $prod_id = $data['product_id'];
        $res = $this->db->table('product_rating')->insert($data);
        $id = $this->db->insertID();
        if ($id) {
            $this->db->query("update products set rating = (select AVG(rating_rate) as avg from product_rating where product_id = $prod_id)  where id = $prod_id");
            return $id;
        } else {
            return false;
        }
    }

    public function add_rating_images($data)
    {
        $product_images = $this->db->table('product_rating_images')->insertBatch($data);
        return $this->db->insertID();
    }

    public function getDiffRatings($id)
    {
        $this->product_rating = $this->db->table('product_rating');
        $res = $this->db->query("select rating_rate,count(*) as count from product_rating where product_id = $id  GROUP by rating_rate")->getResult();
        $rating_rate = [
            '5' => 0,
            '4' => 0,
            '3' => 0,
            '2' => 0,
            '1' => 0,
        ];
        foreach ($res as $a) {
            $rating_rate[$a->rating_rate] = $a->count;
        }
        return $rating_rate;
    }

    public function view_rating_product_img($post_data)
    {

        $prod_id = $post_data['pid'];
        $limit = 10;
        $page = $post_data['page'];
        $offset = ($limit * $page) - $limit;

        return $this->db->table('product_rating pr')
            ->select('pr.*,u.full_name')
            ->where("product_id=$prod_id")
            ->join('users u', 'u.id = pr.user_id')
            ->limit($limit, $offset)
            ->get()->getResult();
    }
    public function get_reviews_count($prod_id)
    {
        $this->product_rating = $this->db->table('product_rating');
        $count_review = $this->db->query("select count(*) as count from product_rating pr join users u ON u.id = pr.user_id where product_id = $prod_id")->getRow();
        return $count_review;
    }

    public function get_last_month_ratings($pid)
    {
        $date = date("Y-m-d");
        $old_date = date("Y-m-d", strtotime("-29 days"));

        $res = $this->db->table('product_rating pr')->select('pr.*,u.full_name')->join('users u', 'u.id=pr.user_id')->where("pr.created_at BETWEEN '$old_date' AND '$date'")->where("product_id=$pid")->get()->getResult();
        return $res;
    }

    public function get_all_images_product_rating($pid)
    {
        $res = $this->db->table('product_rating_images')->where("product_id=$pid")->get()->getResult();
        return $res;
    }

    public function change_status($data, $id)
    {
        // prd($id);
        return $this->builder->set($data)
            ->where('id', $id)
            ->update();
    }
}