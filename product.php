

<?php 

  include "libs/functions.php";

  if(isset($_GET["productId"])){
    $productId = $_GET["productId"];
    $productResult = getProductByProductId($productId);
    $selectedProduct = mysqli_fetch_assoc($productResult);
  }else{
    header("Location: index.php");
    exit;
  }


?>

<?php 
  require "views/_head-start.php";
  require "views/_message.php";
  require "views/_navbar.php";
?>

<section class="products-list">

  <div class="container">

    <div class="card">
      <div class="card-body">

        <div class="row">

          <div class="col-lg-4">
            <img src="img/<?php echo $selectedProduct["image"].'.jpg'; ?>" class="img-thumbnail" alt="">
          </div>
          <div class="col-lg-8">
            <h3 class="mb-3"><?php echo $selectedProduct["name"]; ?></h3>

            <p class="lead my-3"><span class="fw-bold">Ürün Açıklama: </span><?php echo $selectedProduct["description"]; ?></p>

            <h3 class="text-warning">
              <?php if($selectedProduct["old_price"] > $selectedProduct["new_price"]): ?>
              <span class="text-danger text-decoration-line-through me-3">
                <?php echo $selectedProduct["old_price"]."$"; ?>
              </span> 
              <?php endif; ?>
              <?php echo " ".$selectedProduct["new_price"]."$"; ?>
            </h3>

            <a href="addProductToProfile.php?productId=<?php echo $selectedProduct["id"]; ?>" class="btn btn-outline-primary d-block my-5">Satın al</a>
          </div>

        </div>

      </div>
    </div>



  </div>

</section>


<?php 
  require "views/_footer.php";
?>




<?php 
  require "views/_head-finish.php";
?>