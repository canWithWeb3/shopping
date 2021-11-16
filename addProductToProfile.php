

<?php 

  include "libs/functions.php";

  if(isset($_GET["productId"])){

    if(isset($_COOKIE["username"])){
      $userResult = getUserByUsername($_COOKIE["username"]);
      $user = mysqli_fetch_assoc($userResult);

      $productId = $_GET["productId"];

      if(addProductToProfile($user["id"],$productId)){
        $_SESSION["message"] = "Ürün Profilinize eklendi";
        $_SESSION["type"] = "success";
        header("Location: product.php?productId=".$_GET["productId"]);
      }else{
        $_SESSION["message"] = "Ürün zaten listenizdedir.";
        $_SESSION["type"] = "danger";
        header("Location: product.php?productId=".$_GET["productId"]);
      }

    }else{
      $_SESSION["message"] = "Lütfen giriş yapınız";
      $_SESSION["type"] = "warning";
      header("Location: login.php");
      exit;
    }

  }else{
    header("Location: index.php");
    exit;
  }

?>