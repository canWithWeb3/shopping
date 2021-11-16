

<?php 

  include "libs/functions.php";

  $name = "";
  $name_err = "";
  $oldPrice = 0.00;
  
  if(isset($_POST["categoryCreate"])){

    // control name
    if(empty($_POST["name"])){
      $name_err = "Ürün Adı boş geçilemez";
    }elseif(strlen($_POST["name"]) > 160){
      $name_err = "Ürün adı 160 geçemez";
    }else{
      $name = control_input($_POST["name"]);
    }

    if(empty($name_err)){
      if(categoryCreate($name)){
        $_SESSION["message"] = $name."Kategori eklendi";
        $_SESSION["type"] = "success";
        header("Location: admin-categories.php");
      }else{
        echo "kategori eklenemedi";
      }
    }
    

  }

?>

<?php 
  require "views/_head-start.php";
  require "views/_message.php";
  require "views/_navbar.php";
?>

<div class="container my-5">

    
  <div class="card">
    <div class="card-body">

      <form method="POST" novalidate>

        <div class="mb-3">
          <label for="name" class="form-label">Kategori Adı</label>
          <input type="text" class="form-control" name="name" id="name">
        </div>
          
        <button class="btn btn-primary mt-3" name="categoryCreate" type="submit">Kategori Ekle</button>

      </form>

    </div>
  </div>

</div>






<?php 
  require "views/_head-finish.php";
?>