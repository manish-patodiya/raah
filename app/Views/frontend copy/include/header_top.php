<?php
// $navbar_items = [
//     "women ethnic" => [
//         "all women ehtnic" => ["view all"],
//         "sarees" => ["all sarees", "silk sarees", "cotton silk sarees", "georgette sarees", "chiffon sarees", "satin sarees",
//             "embroidered sarees"],
//         "kurtis" => ["all kurtis", "anarkali kurtis", "raton kurtis", "cotton kurtis", "embroidered kurtis"],
//         "kurta sets" => ["all kurta sets"],
//         "suits & dress material" => ["all suits & dress material", "cotton suits", "embroidered suits", "chanderi suits"],
//         "other ethenic" => ["blouses", "dupattas", "lehanga", "gown", "ethnic bottomwear",
//         ],
//     ],
//     'women western' => [
//         'topwear' => ['tops', 'dresses', 'sweaters', 'jumpsuites'],
//         'bottomwear' => ['jeans', 'jeggings', 'palazzos', 'shorts', 'skirts'],
//         'innerwear' => ['bra', 'briefs'],
//         'sleepwear' => ['nightsuits', 'babydolls'],
//     ],
//     'men' => [
//         'topwear' => ['all top wears', 'tshirts', 'shirts'],
//         'bottom wear' => ['track pants', 'jeans', 'trousers'],
//         'men accessories' => ['all men accessories', 'watches', 'belts', 'wallets', 'jewellery', 'sunglasses', 'bags'],
//         'men footwear' => ['casual shoes', 'sports shoes' . 'sandals', 'formal shoes'],
//         'ethnic wear' => ['men kurtas', 'ethnic jackets'],
//         'inner & sleep wear' => ['all inner & sleep wears', 'vests'],
//     ],
//     'kids' => [
//         'boys & girls 2+ years' => ['dresses'],
//         'infant 0-2 years' => ['rompers'],
//         'toys & accessories' => ['soft toys', 'footwear', 'stationery', 'watches', 'bags & backpacks'],
//         'baby care' => ['all baby care'],
//     ],
//     'home & kitchen' => [
//         'home furnishing' => ['badsheets', 'doormats', 'curtains & sheers', 'cushions & cushion covers', 'mattress protectors'],
//         'home decor' => ['all home decor', 'stickers', 'clocks', 'showpieces'],
//         'kitchen & dining' => ['kitchen storage', 'Cookware & Bakeware'],
//     ],
//     'beauty & health' => [
//         'make up' => ['face', 'eyes', 'lips', 'nails'],
//         'wellness' => ['sanitizers', 'oral care', 'faminine hygiene'],
//         'skincare' => ['deodorants'],
//     ],
//     'jewellery & accessories' => [
//         'jewellery' => ['jewellery sets', 'earrings', 'mangalsutras', 'studs', 'bangles', 'necklaces', 'rings', 'anklets'],
//         'women accessories' => ['bags', 'watched', 'hair accessories', 'sunglasses', 'socks'],
//     ],
//     'bags & footwear' => [
//         'women bags' => ['all women bags', 'handbags', 'clutches', 'slingbags'],
//         'men bags' => ['all men bags', 'men wallets'],
//         'women footwear' => ['flats', 'bellies', 'juttis'],
//     ],
//     'electronics' => [
//         'mobile & accessories' => ['all mobile and accessories', 'smartwatches', 'mobile holders', 'mobile cases and covers'],
//         'appliances' => ['all appliances', 'gromming', 'home appliances'],
//     ],

// ];
// $navbar_items = [
//     'Cloth Items' => ['Odhani', 'blouse', 'sari', 'kurta', 'salwar', 'turban', 'chunni', 'shirt', 't-shirt', 'bed sheets', 'table cover', 'curtain', 'purse', 'band', 'rainbow tie', 'hats', 'socks', 'handkerchief', 'track shoot', 'sports wear'],
//     'leather items' => [],
//     'wood carving' => [],
//     'stone carving' => [],
//     'lakh art work' => [],
// ];
// model('CategoryModel')->script($navbar_items);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="<?php echo isset($seo_title) ? $seo_title : '' ?>" content="<?php echo isset($seo_description) ? $seo_description : '' ?>">

    <link rel="icon" href="<?php echo base_url('public/images/favicon.ico') ?>">

    <title><?php echo isset($title) ? $title : 'myktdc' ?></title>

    <!-- Vendors Style-->
    <link rel="stylesheet" href="<?php echo base_url('public/frontend/css/vendors_css.css') ?>">

    <link rel="stylesheet" href="<?php echo base_url('public/frontend/css/horizontal-menu.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('public/frontend/css/style.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('public/frontend/css/skin_color.css') ?>">
    <script>
        const BASE_URL = "<?php echo base_url(); ?>";

        function base_url(uri) {
            return BASE_URL + uri;
        }
    </script>
    <style>
        body,
        .content-wrapper {
            background-color: white;
        }

        .chip {
            display: inline-block;
            height: 32px;
            padding: 0 12px;
            margin-right: 1rem;
            margin-bottom: 1rem;
            font-size: 13px;
            font-weight: 500;
            line-height: 32px;
            color: rgba(0, 0, 0, 0.6);
            cursor: pointer;
            background-color: #eceff1;
            border-radius: 16px;
            -webkit-transition: all .3s linear;
            transition: all .3s linear;
            text-transform: capitalize;
        }
    </style>
</head>

<body class="layout-top-nav light-skin theme-primary fixed">

    <div class="wrapper">