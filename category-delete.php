<?php 
require 'libs/variables.php';

require 'libs/functions.php';

session_start();

$id = $_GET["id"];
if(categoryDelete($id)){
   $_SESSION["message"] = $id ." numaralı kategori silinmiştir!";
   $_SESSION["type"] = "danger";
   
   header('Location: admin-categories.php');
}
else{
    echo "hata";
}


?>