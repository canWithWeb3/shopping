

<?php 
  if(isset($_COOKIE["username"])){
    setcookie("username",$_COOKIE["username"], time() - (36400*30));
    if(isset($_COOKIE["type"])){
      setcookie("type",$_COOKIE["type"], time() - (36400*30));
    }
    header("Location: index.php");
  }else{
    header("Location: index.php");
    exit;
  }
?>