

<?php 

  include "libs/functions.php";

  $name = $image = $description = $newPrice = "";
  $name_err = $image_err = $description_err = $newPrice_err = "";
  

  if(isset($_POST["productCreate"])){

    // control name
    if(empty($_POST["name"])){
      $name_err = "Ürün Adı boş geçilemez";
    }elseif(strlen($_POST["name"]) > 260){
      $name_err = "Ürün adı 260 geçemez";
    }else{
      $name = control_input($_POST["name"]);
    }

    // control image
    if(empty($_POST["image"])){
      $image_err = "İmage boş geçilemez";
    }else{
      $image = $_POST["image"];
    }

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
      if(!empty($_POST["oldPrice"])){
        $oldPrice = control_input($_POST["oldPrice"]);
      }else{
        $oldPrice = 0.00;
      }

      $newPrice = control_input($_POST["newPrice"]);
    }

    if(empty($_POST["categories"])){
      $categories_err = "Kategori girmediniz";
    }else{
      $categories = $_POST["categories"];
    }

    if(empty($name_err) && empty($image_err) && empty($description_err) && empty($newPrice_err)){
      if(productCreate($name,$image,$description,$oldPrice,$newPrice)){
        
        // getProductByProductName
        $productResult = getProductByProductName($name);
        $product = mysqli_fetch_assoc($productResult);
        $productId = $product["id"];

        if(addCategoryToBlog($productId,$categories)){
          $_SESSION["message"] = "Ürün ve kategorileri eklendi";
          $_SESSION["type"] = "success";
          header("Location: admin-products.php");
        }else{
          $_SESSION["message"] = "Ürün eklendi fakat kategorileri eklenemedi";
          $_SESSION["type"] = "warning";
          header("Location: admin-products.php");
        }
      }else{
        $_SESSION["message"] = "Ürün ve kategorileri eklenemedi";
          $_SESSION["type"] = "danger";
          header("Location: admin-products.php");
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

          <div class="col-lg-9">

            <div class="mb-3">
              <label for="name" class="form-label">Ürün Adı</label>
              <input type="text" class="form-control" name="name" id="name">
              <span class="invalid-feedback"><?php if(!empty($name_err)){echo $name_err;}?></span>
            </div>

            <div class="mb-3">
              <label for="image" class="form-label">Ürün Resmi</label>
              <input type="text" class="form-control" name="image" id="image">
              <span class="invalid-feedback"><?php if(!empty($image_err)){echo $image_err;}?></span>
            </div>

            <div class="mb-3">
              <label for="description" class="form-label">Ürün Açıklama</label>
              <input type="text" class="form-control" name="description" id="description">
              <span class="invalid-feedback"><?php if(!empty($description_err)){echo $description_err;}?></span>
            </div>

            <div class="mb-3 d-flex">
              <div class="row">
                <div class="col-6">
                  <label for="oldPrice" class="form-label">Eski Fiyat</label><span class="text-info ms-3">İsteğe bağlı</span>
                  <input type="number" class="form-control" name="oldPrice" id="oldPrice" placeholder="0">
                </div>
                <div class="col-6">
                  <label for="newPrice" class="form-label">Yeni Fiyat</label>
                  <input type="number" class="form-control" name="newPrice" id="newPrice" placeholder="0">
              <span class="invalid-feedback"><?php if(!empty($name_err)){echo $newPrice_err;}?></span>
                </div>
              </div>
            </div>

          </div>

          <div class="col-lg-3 mt-3">

            <div class="card">
              <div class="card-header text-center">Ürün Kategori</div>
              <div class="card-body">

                <?php $categories = getCategories(); ?>
                <?php while($category = mysqli_fetch_assoc($categories)): ?>

                  <div class="form-check">
                    <label for="<?php echo $category["id"];?>" class="form-check-label"><?php echo $category["name"];?></label>
                    <input type="checkbox" class="form-check-input" name="categories[]" id="<?php echo $category["id"];?>"
                      value="<?php echo $category["id"];?>"
                    >
                  </div>

                <?php endwhile; ?>

              </div>
              <span class="invalid-feedback"><?php if(!empty($categories_err)){echo $categories_err;}?></span>
            </div>

          </div>

        </div>

        <button class="btn btn-primary mt-3" name="productCreate" type="submit">Ürünü Ekle</button>

      </form>

    </div>
  </div>

</div>






<?php 
  require "views/_head-finish.php";
?>