<?php 


require_once('./core/login.php');


logout();


echo "<script language=\"javascript\">\n";
echo "window.location = \"" . $u->getSiteUrl() . "index.php?page=home\";\n";
echo "</script>\n";


?>