<?php


$conn = mysqli_connect("localhost","root","","ecommerce");
// echo gettype($conn);
define('SERVER_PATH', $_SERVER['DOCUMENT_ROOT'].'/ecommerce/Admin/USER_ADMIN_PANLE/');
define('SITE_PATH', 'http://localhost/ecommerce/Admin/USER_ADMIN_PANLE/');

define('PRODUCT_IMAGE_SERVER_PATH', SERVER_PATH.'media/ALL_PRODUCTS/');
define('PRODUCT_IMAGE_SITE_PATH', SITE_PATH.'media/ALL_PRODUCTS/'); //add in all codes

if(!$conn){
//     echo "success";
// }
// else{
    die("error".mysqli_connect_error());
}

?>