

<?php 

  include "libs/functions.php";

  $name = $image = $description = $newPrice = "";
  $name_err = $image_err = $description_err = $newPrice_err = $category_err = "";
  $oldPrice = 0;


  if(isset($_GET["productId"])){
    $productId = $_GET["productId"];
    $productResult = getProductByProductId($productId);
    $product = mysqli_fetch_assoc($productResult);
  }else{
    header("Location: index.php");
    exit;
  }


  if(isset($_POST["productEdit"])){

    // control name
    if(empty($_POST["name"])){
      $name_err = "Ürün Adı boş geçilemez";
    }elseif(strlen($_POST["name"]) > 260){
      $name_err = "Ürün adı 260 geçemez";
    }else{
      $name = control_input($_POST["name"]);
    }

    $image = $_POST["image"];

    // control description
    if(empty($_POST["description"])){
      $description_err = "Ürün Açıklama boş geçilemez";
    }elseif(strlen($_POST["description"]) > 560){
      $description_err = "Ürün Açıklama 560 geçemez";
    }else{
      $description = control_input($_POST["description"]);
    }

    // control newPrice and oldPrice
    if(empty($_POST["newPrice"])){
      $newPrice_err = "Ürün Yeni Fiyat boş geçilemez";
    }elseif($_POST["newPrice"] == $_POST["oldPrice"]){
      $newPrice_err = "Ürün Fiyatları aynı giremezsiniz";
    }else{
      
      // control oldPrice
      if(empty($_POST["oldPrice"])){
        $oldPrice = 0;
      }else{
        $oldPrice = control_input($_POST["oldPrice"]);
      }

      $newPrice = control_input($_POST["newPrice"]);
    }

    if(empty($_POST["categories"])){
      $category_err = "Kategori girmediniz";
    }else{
      $categories = $_POST["categories"];
    }


    if(empty($name_err) && empty($image_err) && empty($description_err) && empty($newPrice_err) && empty($category_err)){
      if(productEdit($productId,$name,$image,$description,$oldPrice,$newPrice)){
        clearCategoriesByProductId($productId);
        if(addCategoryToBlog($productId,$categories)){
          $_SESSION["message"] = "Ürün kategorileriyle güncellendi";
          $_SESSION["type"] = "success";
          header("Location:admin-products.php");
        }else{
          $_SESSION["message"] = "Ürün güncellendi fakat kategorileriyle güncellenemedi";
          $_SESSION["type"] = "warning";
          header("Location:admin-products.php");
        }
      }else{
          $_SESSION["message"] = "Ürün güncellenemedi";
          $_SESSION["type"] = "danger";
          header("Location:admin-products.php");
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

      <form method="POST" enctype="multipart/form-data" novalidate>

        <div class="row">

          <!-- Product add -->
          <div class="col-lg-9">
            
            <div class="mb-3">
              <label for="name" class="form-label">Ürün Adı</label>
              <input type="text" class="form-control" name="name" id="name" value="<?php echo $product["name"];?>">
              <span class="invalid-feedback"><?php if(!empty($name_err)){echo $name_err;} ?></span>
            </div>

            <div class="mb-3">
              <label for="image" class="form-label">Ürün Resmi</label>
              <input type="text" class="form-control" name="image" id="image" value="<?php echo $product["image"];?>">
              <span class="invalid-feedback"><?php if(!empty($image_err)){echo $image_err;} ?></span>
            </div>

            <div class="mb-3">
              <label for="description" class="form-label">Ürün Açıklama</label>
              <input type="text" class="form-control" name="description" id="description" value="<?php echo $product["description"];?>">
              <span class="invalid-feedback"><?php if(!empty($description_err)){echo $description_err;} ?></span>
            </div>

            <div class="mb-3 d-flex">
              <div class="row">
                <div class="col-6">
                  <label for="oldPrice" class="form-label">Eski Fiyat</label><span class="text-info ms-3">İsteğe bağlı</span>
                  <input type="text" class="form-control" name="oldPrice" id="oldPrice" placeholder="0" value="<?php echo $product["old_price"];?>">
                </div>
                <div class="col-6">
                  <label for="newPrice" class="form-label">Yeni Fiyat</label>
                  <input type="text" class="form-control" name="newPrice" id="newPrice" placeholder="0" value="<?php echo $product["new_price"];?>">
              <span class="invalid-feedback"><?php if(!empty($newPrice_err)){echo $newPrice_err;} ?></span>
                </div>
              </div>
            </div>

          </div>

          <!-- Product categories -->
          <div class="col-lg-3 mt-3">

            <div class="card">
              <div class="card-header text-center">Ürün Kategori</div>
              <div class="card-body">

                <?php $getCategories = getCategories(); ?>

                <?php while($category = mysqli_fetch_assoc($getCategories)): ?>
                  <div class="form-check">
                    <label for="<?php echo $category["id"];?>" class="form-check-label"><?php echo $category["name"];?></label>
                    <input type="checkbox" class="form-check-input" name="categories[]" id="<?php echo $category["id"];?>"
                      value="<?php echo $category["id"];?>"

                      <?php $selectedCategories = getCategoriesByProductId($product["id"]); ?>    
                      <?php foreach($selectedCategories as $sc){
                        if($sc["id"] == $category["id"]){
                          echo "checked";
                        }
                      } ?>
                      >
                  </div>
                <?php endwhile; ?>

                <div class="text-danger fs-5"><?php if(!empty($category_err)){echo $category_err;}?></div>

              </div>
            </div>

          </div>

        </div>

        <button class="btn btn-primary mt-3" name="productEdit" type="submit">Ürünü Güncelle</button>

      </form>

    </div>
  </div>

</div>






<?php 
  require "views/_head-finish.php";
?>