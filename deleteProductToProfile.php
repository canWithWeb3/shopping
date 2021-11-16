

<?php 
  include "libs/functions.php";

  if(isset($_GET["productId"])){

    if(isset($_COOKIE["username"])){
      
      $username = getUserByUsername($_COOKIE["username"]);
      $user = mysqli_fetch_assoc($username);
      $userId = $user["id"];

      $productId = $_GET["productId"];

      if(deleteProductToProfile($userId,$productId)){
        $_SESSION["message"] = "Ürün profilinizden silindi";
        $_SESSION["type"] = "success";
        header("Location: profile.php");
      }else{
        $_SESSION["message"] = "Ürün silinemedi";
        $_SESSION["type"] = "danger";
        header("Location: profile.php");
      }

    }else{
      $_SESSION["username"] = "Lütfen giriş yapınız";
      $_SESSION["type"] = "warning";
      header("Location: login.php");
      exit;
    }

  }else{
    header("Location: profile.php");
    exit;
  }
?>