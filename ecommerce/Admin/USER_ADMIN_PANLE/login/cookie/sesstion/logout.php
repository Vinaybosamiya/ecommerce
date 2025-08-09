<?php
session_start();
session_unset();
session_destroy();
echo "your sesstion is logged out now "
?>