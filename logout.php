<?php 


require_once('./core/login.php');


logout();


echo "<script language=\"javascript\">\n";
echo "window.location = \"index.php?page=home\";\n";
echo "</script>\n";


?>