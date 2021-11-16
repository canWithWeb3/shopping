

<?php 

  include "libs/functions.php";
  
  if(isset($_GET["categoryId"])){
    $categoryId = $_GET["categoryId"];
    if(categoryDelete($categoryId)){
      $_SESSION["message"] = "Kategori Silindi";
      $_SESSION["type"] = "success";
      header("Location: admin-categories.php");
    }else{
      $_SESSION["message"] = "Kategori Silinemedi";
      $_SESSION["type"] = "danger";
      header("Location: admin-categories.php");
    }
  }else{
    header("Location: index.php");
    exit;
  }
?>