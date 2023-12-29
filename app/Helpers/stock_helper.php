<?php

function updateStock($product_id, $qty, $action)
{
    $model = model('StockManagementModel');
    $prev_stock = $model->getStockOfProduct($product_id);
    if ($action == 'add') {
        $stock_qty = $prev_stock + $qty;
    } else {
        $stock_qty = $prev_stock - $qty;
    }
    return $model->updateStock($product_id, $stock_qty);
}

function insertStock()
{

}

function updateLowStock()
{

}