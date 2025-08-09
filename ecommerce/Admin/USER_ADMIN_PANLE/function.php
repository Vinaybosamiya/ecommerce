<?php

// include "_dbconnect.php";
function pr($arr)
{
    echo "<pre>";
    print_r($arr);
}

function prx($arr){
    echo"<pre>";
    print_r($arr);
    die();
}

function get_safe_val($conn,$str)
{
    $str=trim($str);
    if($str != ''){
        return mysqli_real_escape_string($conn,$str);
    }
}
?>