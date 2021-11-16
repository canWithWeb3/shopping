

<?php 

  include "libs/functions.php";

  $name = "";
  $name_err = "";

  if(isset($_GET["categoryId"])){
    $categoryId = $_GET["categoryId"];
    $categoryResult = getCategoryByCategoryId($categoryId);
    $category = mysqli_fetch_assoc($categoryResult);
  }else{
    header("Location: index.php");
  }
  
  if(isset($_POST["categoryEdit"])){

    // control name
    if(empty($_POST["name"])){
      $name_err = "Ürün Adı boş geçilemez";
    }elseif(strlen($_POST["name"]) > 160){
      $name_err = "Ürün adı 160 geçemez";
    }else{
      $name = control_input($_POST["name"]);
    }

    if(empty($name_err)){
      if(categoryEdit($categoryId,$name)){
        $_SESSION["message"] = $name." Kategori Güncellendi";
        $_SESSION["type"] = "success";
        header("Location: admin-categories.php");
      }else{
        echo "kategori güncellenemedi";
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
          <input type="text" class="form-control" name="name" id="name" 
          value="<?php echo strtoupper($category["name"]);?>">
        </div>
          
        <button class="btn btn-primary mt-3" name="categoryEdit" type="submit">Kategori Düzenle</button>

      </form>

    </div>
  </div>

</div>






<?php 
  require "views/_head-finish.php";
?>