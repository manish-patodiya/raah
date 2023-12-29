<?php

function prd($data)
{
    echo "<pre>";
    print_r($data);
    die;
}

function pr($data)
{
    echo "<pre>";
    print_r($data);
}

function to_fixed($number, $ad = 2)
{
    return number_format($number, $ad, '.', '');
}

function isActive($ctrl, $mthd = false)
{
    $router = service('router');
    $controller = $router->controllerName();
    $controllerName = explode('\\', $controller);
    $controllerName = strtolower(end($controllerName));
    $method = $router->methodName();
    $methodName = explode('\\', $method);
    $methodName = strtolower(end($methodName));
    if (!$mthd) {
        echo $controllerName == $ctrl ? "active" : "";
    } else {
        echo $controllerName == $ctrl && $methodName == $mthd ? "active" : "";
    }
}

function json_response($status, $msg, $data = [])
{
    echo json_encode([
        'status' => $status,
        'msg' => $msg,
        'data' => $data,
    ]);
    exit;
}

function format_name($s)
{
    return ucwords(strtolower(trim($s)));
}

function encrypt_password($plaintext)
{
    $encrypter = service('encrypter');
    return base64_encode($encrypter->encrypt($plaintext));
}

function decrypt_password($plaintext)
{
    $encrypter = service('encrypter');
    return $encrypter->decrypt(base64_decode($plaintext));
}

function trans($string, $data = [])
{
    return lang("site_lang.$string", $data);
}

function time_diff_string($from, $to, $full = false)
{
    date_default_timezone_set("Asia/Calcutta");
    $from = new DateTime($from);
    $to = new DateTime($to);
    $diff = $to->diff($from);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) {
        $string = array_slice($string, 0, 1);
    }

    return $string ? implode(', ', $string) . ' ago' : 'just now';
}

function unique_ticket_id()
{
    return strtoupper(uniqid());
}

function generate_otp()
{
    return rand(100000, 999999);
}

function encrypt_var($s)
{
    $encrypter = service('encrypter');
    return rawurlencode(base64_encode($encrypter->encrypt($s)));
}

function decrypt_var($s)
{
    $encrypter = service('encrypter');
    return $encrypter->decrypt(base64_decode(rawurldecode($s)));
}

function generate_uniqcode()
{
    return uniqid() . time();
}

/* HTML helper function */

//Shorthand to create anchor link
function anchor($title, $url, $attr = [])
{
    if (!filter_var($url, FILTER_VALIDATE_URL)) {
        $url = base_url($url);
    }
    $props = [];
    foreach ($attr as $k => $v) {
        $props[] = "$k=\"$v\"";
    }
    echo "<a href=\"$url\" " . implode(" ", $props) . ">$title</a>";
}

function create_slug($str)
{
    return preg_replace('/[^A-Za-z0-9-]+/', '-', $str);
}

function unique_string($c)
{
    $bytes = random_bytes($c);
    return bin2hex($bytes);
}