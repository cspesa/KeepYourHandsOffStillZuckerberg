
<?php

setcookie("username", $myusername, time() - 3600);
header("Location: homepage.php");
?>
