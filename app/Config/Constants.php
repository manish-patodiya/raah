<?php

/*
| --------------------------------------------------------------------
| App Namespace
| --------------------------------------------------------------------
|
| This defines the default Namespace that is used throughout
| CodeIgniter to refer to the Application directory. Change
| this constant to change the namespace that all application
| classes should use.
|
| NOTE: changing this will require manually modifying the
| existing namespaces of App\* namespaced-classes.
 */
defined('APP_NAMESPACE') || define('APP_NAMESPACE', 'App');

/*
| --------------------------------------------------------------------------
| Composer Path
| --------------------------------------------------------------------------
|
| The path that Composer's autoload file is expected to live. By default,
| the vendor folder is in the Root directory, but you can customize that here.
 */
defined('COMPOSER_PATH') || define('COMPOSER_PATH', ROOTPATH . 'vendor/autoload.php');

/*
|--------------------------------------------------------------------------
| Timing Constants
|--------------------------------------------------------------------------
|
| Provide simple ways to work with the myriad of PHP functions that
| require information to be in seconds.
 */
defined('SECOND') || define('SECOND', 1);
defined('MINUTE') || define('MINUTE', 60);
defined('HOUR') || define('HOUR', 3600);
defined('DAY') || define('DAY', 86400);
defined('WEEK') || define('WEEK', 604800);
defined('MONTH') || define('MONTH', 2592000);
defined('YEAR') || define('YEAR', 31536000);
defined('DECADE') || define('DECADE', 315360000);

/*
| --------------------------------------------------------------------------
| Exit Status Codes
| --------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
 */
defined('EXIT_SUCCESS') || define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR') || define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG') || define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE') || define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS') || define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') || define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT') || define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE') || define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN') || define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX') || define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code

defined('SITE_NAME') || define("SITE_NAME", "My KTDC");

//Email Setting

defined("EMAIL_FROM") || define("EMAIL_FROM", "reply@arvindjangir.com");
defined("EMAIL_FROM_NAME") || define("EMAIL_FROM_NAME", "INVENTO");

// tax related info
defined("UT_CODES") || define("UT_CODES", ['35', '04', '26', '38', '97']);
defined("TAXES") || define("TAXES", [5, 12, 18, 28]);
defined("GST_NAMES") || define("GST_NAMES", ['CGST', 'SGST', 'UTGST', 'IGST']);

// roles
defined('ADMIN_ROLE_ID') || define("ADMIN_ROLE_ID", 1);
defined('SELLER_ROLE_ID') || define("SELLER_ROLE_ID", 2);
defined('CUSTOMER_ROLE_ID') || define("CUSTOMER_ROLE_ID", 3);

// image diff sizes
defined("IMAGE_SIZES") || define("IMAGE_SIZES", ["30" => "30X30", "100" => "100X100", "200" => "200X200"]);

// notification template variable
defined('NOTIFICATION_TEMPLATE_VARIABLE') || define("NOTIFICATION_TEMPLATE_VARIABLE", [
    '{site_name}' => 'For add site name in your cotent.',
    '{site_logo}' => 'For add site logo in your cotent.',
    '{site_url}' => 'For add site url in your cotent.',
]);

// url expired time
defined('URL_EXPIRATION_TIME') || define("URL_EXPIRATION_TIME", 86400);

// regex
defined('EMAIL_REGEX') || define("EMAIL_REGEX", `/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/`);

defined('URL_REGEX') || define("URL_REGEX", `/^(https?|s?ftp):\/\/(((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:)*@)?(((\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5]))|((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?)(:\d*)?)(\/((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)+(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*)?)?(\?((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|[\uE000-\uF8FF]|\/|\?)*)?(#((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|\/|\?)*)?$/i`);

defined('PHONE_REGEX') || define("PHONE_REGEX", `/^[6-9]\d{9}$/gi`);
defined('PASSWORD_REGEX') || define("PASSWORD_REGEX", `/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%#*?&])[A-Za-z\d@$!#%*?&]{8,}$/`);

//CUSTOM CONTSTANT

defined("OFFICIAL_TITLE") || define("OFFICIAL_TITLE", "My KTDC");
defined("OFFICIAL_CONTACT") || define("OFFICIAL_CONTACT", "+91-90010 05900");
defined("OFFICIAL_EMAIL") || define("OFFICIAL_EMAIL", "ktdckolsiya@gmail.com");
defined("OFFICIAL_ADDRESS") || define("OFFICIAL_ADDRESS", "Kolsiya Tie & Dye Center <br> Kolsiya, Jhunjhunu, Rajasthan (333042)");

//Social media account
defined("URL_LINKEDIN") || define("URL_LINKEDIN", "https://www.linkedin.com/in/ktdc-kolsiya-ba7764252/");
defined("URL_FACEBOOK") || define("URL_FACEBOOK", "https://facebook.com/myktdc");
defined("URL_TWITTER") || define("URL_TWITTER", "https://twitter.com/myktdc");
defined("URL_YOUTUBE") || define("URL_YOUTUBE", "https://www.youtube.com/channel/UCcagjEjShyQt3JlT_gyZRng");

//Mobile APPs
defined("APP_ANDROID") || define("APP_ANDROID", "https://play.google.com/store/apps");
defined("APP_IOS") || define("APP_IOS", "https://www.apple.com");

//Product constant 
defined("PRODUCT_IMG_FILE_PATH") || define("PRODUCT_IMG_FILE_PATH", "./public/uploads/product_images/");
defined("PRODUCT_IMG_PATH") || define("PRODUCT_IMG_PATH", "public/uploads/product_images/");