<?php
$c = "gamming";
if($c == "gamming") {
    setcookie("category",$c,time() + 10,"/");
    echo "user your category ".$c." cookie is set<br>";
}
?>