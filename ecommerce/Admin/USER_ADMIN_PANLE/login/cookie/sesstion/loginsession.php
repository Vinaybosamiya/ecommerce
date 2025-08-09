<?php
session_start();
if(isset($_SESSION['username'])){
    echo "welcome to our website".$_SESSION['username'].'<br>';
   echo "your fevlrite cetegory is ". $_SESSION['category'].'<br>';
}
else{
    echo "please login first";
}
?>