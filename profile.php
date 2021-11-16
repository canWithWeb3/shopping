

<?php 

  include "libs/functions.php";

  if(isset($_COOKIE["username"])){

    $username = getUserByUsername($_COOKIE["username"]);
    $user = mysqli_fetch_assoc($username);

    $userProductResult = getProductsByUserId($user["id"]);

  }else{
    $_SESSION["message"] = "Giriş yapınız";
    $_SESSION["type"] = "warning";
    header("Location: login.php");
    exit;
  }


?>

<?php 
  require "views/_head-start.php";
  require "views/_message.php";
  require "views/_navbar.php";
?>

<section class="products-list mb-5">

  <div class="container">

      <div class="fs-5 mb-3"><?php echo $user["username"]; ?></div>

      <!-- User Infos -->
      <div class="card mb-5">
          <div class="card-body">
            <div class="row g-3">

              <div class="col-md-3 col-6">
                <img src="./img/pic-3.png" class="img-thumbnail" alt="">
              </div>

              <div class="col-lg-6 col-md-9 col-12">

                <form>
                  <div class="mb-3">
                    <label for="username" class="form-label">Kullanıcı adı</label>
                    <input type="text" name="addreusernamess" class="form-control" value="<?php echo $user["username"]; ?>">
                  </div>
                  
                  <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" name="email" class="form-control" value="<?php echo $user["email"]; ?>">
                  </div>
                  
                  <div class="mb-3">
                    <label for="address" class="form-label">Adres</label>
                    <input type="text" name="address" class="form-control" value="<?php echo $user["address"]; ?>">
                  </div>

                  <button type="submit" class="btn btn-outline-primary">Kişiyi güncelle</button>
                </form>

              </div>

            </div>
        </div>
      </div>

      <div class="row g-3">

      <h3 class="fs-5 mb-3 text-center text-uppercase text-decoration-underline fw-bold">Kullanıcın ürünleri</h3>

        <?php while($product = mysqli_fetch_assoc($userProductResult)): ?>
        <div class="col-lg-3 col-md-4 col-6 clearfix d-flex align-items-stretch">
            <div class="card">
              <a class="h-75" href="product.php?productId=<?php echo $product["id"]; ?>">
                <img src="img/<?php echo $product["image"];?>.jpg" class="card-img-top" alt="...">
              </a>
              <div class="card-body">
                <h5 class="card-title my-1"><?php echo $product["name"];?></h5>
                <div class="stars my-1">
                  <i class="fas fa-star text-warning"></i>
                  <i class="fas fa-star text-warning"></i>
                  <i class="fas fa-star text-warning"></i>
                  <i class="fas fa-star text-warning"></i>
                  <i class="fas fa-star-half-alt text-warning"></i>
                </div>
                <div class="product-price text-muted d-flex my-1">
                  <?php if($product["old_price"] != 0):?>
                    <div class="old-price text-decoration-line-through fs-5">370 $ </div> /
                  <?php endif; ?> 
                    
                  <div class="new-price fs-5"><?php echo $product["new_price"]."$";?></div>
                </div>
                <a href="" class="btn btn-outline-primary mt-3">Satın al</a>
                <a href="deleteProductToProfile.php?productId=<?php echo $product["id"]; ?>" class="btn btn-danger mt-3 float-end">Sil</a>
              </div>
            </div>
        </div>
        <?php endwhile; ?>

      </div>

  </div>

</section>

<?php 
  require "views/_footer.php";
?>

<?php 
  require "views/_head-finish.php";
?>