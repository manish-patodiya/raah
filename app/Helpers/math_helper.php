<?php
function get_percentage_by_discount($amt, $dis)
{
    return intval(($dis / $amt) * 100);
}

function get_discount_by_percentage($amt, $per)
{
    return intval(($amt * $per) / 100);
}

function fmt_amt($amt)
{
    return number_format($amt);
}