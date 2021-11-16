

<?php 

  include "libs/functions.php";

  if(isset($_GET["productId"])){
    $productId = $_GET["productId"];
    if(productDelete($productId)){
      if(clearCategoriesByProductId($productId)){
        $_SESSION["message"] = "Ürün kategorileriyle silindi";
        $_SESSION["tpye"] = "success";
        header("Location: admin-products.php");
      }else{
        $_SESSION["message"] = "Ürün silindi fakat kategoriler silinemedi";
        $_SESSION["tpye"] = "warning";
        header("Location: admin-products.php");
      }
    }else{
        $_SESSION["message"] = "Ürün kategorileriyle silinemedi";
        $_SESSION["tpye"] = "danger";
        header("Location: admin-products.php");
    }
  }else{
    header("Location: index.php");
  }

?>

