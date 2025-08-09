<?php
function pr($arr)
{
    echo "<pre>";
    print_r($arr);
}

function prx($arr)
{
    echo "<pre>";
    print_r($arr);
    die();
}

function get_safe_val($conn, $str)
{
    $str = trim($str);
    if ($str != '') {
        return mysqli_real_escape_string($conn, $str);
    }
}
// FIXME: BELOW CODE IS SUCCESSFULLY WORDKED
function get_prod($conn, $limit = '', $cat_id = '', $Product_id = '')
{
    $sql = "SELECT product.*, categoris.categories 
            FROM product 
            JOIN categoris ON product.categories_id = categoris.id 
            WHERE product.status = 1 ";

    if ($cat_id != '') {
        $sql .= "AND product.categories_id = $cat_id ";
    }

    if ($Product_id != '') {
        $sql .= "AND product.id = $Product_id ";
    }

    $sql .= "ORDER BY product.id DESC ";

    if ($limit != '') {
        $sql .= "LIMIT $limit";
    }

    $res = mysqli_query($conn, $sql);
    $letest_data = array();
    while ($row = mysqli_fetch_assoc($res)) {
        $letest_data[] = $row;
    }

    return $letest_data;
}
// TODO: BELOW IS THE OLD FUNCTION AND AVAILABLE ERROR FOR WEBSITE INDEX PAGE
// function get_prod($conn, $type, $limit, $cat_id='')
// function get_prod($conn, $limit, $cat_id ='', $Product_id = '')

// {

//     $sql = "select product.*,categoris.categories from product,categoris where product.status = 1 ";
//     if ($cat_id != '') {
//         $sql .= "and product.categories_id = $cat_id ";
//     }if ($Product_id != '') {
//         $sql .= "and product.id = $Product_id ";
//     }
//      $sql .= "and product.categories_id = categoris.id ";
//     // if ($type == 'letest') {
//     //     $sql .= " order by id desc ";
//     // }
//     $sql .= " order by product.id desc ";
//     if ($limit != '') {
//         $sql .= " product.limit $limit";
//     }
//     $res = mysqli_query($conn, $sql);
//     $letest_data = array();
//     while ($row = mysqli_fetch_assoc($res)) {
//         $letest_data[] = $row;
//     }
//     return $letest_data;
// }
