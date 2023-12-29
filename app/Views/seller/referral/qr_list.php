<?php
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo base_url('public/css/vendors_css.css') ?>">
    <title>Document</title>
    <style>
        @page {
            size: A4;
            margin: 0 17mm 0 17mm;
            margin: 17mm 17mm 17mm 17mm;
        }

        html,
        body {
            width: 210mm;
            height: 297mm;
            border: 1px solid,
        }
    </style>
</head>

<body class='border '>
    <?php if ($per_page == 1) : ?>
        <div class='d-flex align-items-center h-100 w-100'>
            <img src="<?php echo $url ?>" class='w-100' />
        </div>

    <?php elseif ($per_page == 2) : ?>
        <div class='w-100 h-100 d-flex flex-column align-items-center'>
            <div class='h-50'>
                <img src="<?php echo $url ?>" class='h-100' />+
            </div>
            <div class='h-50'>
                <img src="<?php echo $url ?>" class='h-100' />
            </div>
        </div>

    <?php elseif ($per_page == 4) : ?>
        <?php $i = 1;
        while ($i <= 2) : ?>
            <div class='h-50 d-flex justify-content-center align-items-center'>
                <div class='w-50'>
                    <img src="<?php echo $url ?>" class='w-100' />
                </div>
                <div class='w-50'>
                    <img src="<?php echo $url ?>" class='w-100' />
                </div>
            </div>
        <?php ++$i;
        endwhile; ?>

    <?php elseif ($per_page == 8) : ?>
        <?php $i = 1;
        while ($i <= 4) : ?>
            <div class='h-25 d-flex justify-content-center align-items-center'>
                <div class='w-50 h-100 d-flex justify-content-center'>
                    <img src="<?php echo $url ?>" class='h-100' />
                </div>
                <div class='w-50 h-100 d-flex justify-content-center'>
                    <img src="<?php echo $url ?>" class='h-100' />
                </div>
            </div>
        <?php ++$i;
        endwhile; ?>
    <?php endif; ?>

</body>

</html>