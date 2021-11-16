

<?php 

  $products = getProducts();
?>

<section class="products-list">

  <div class="container mt-3 mb-5 ">
    <div class="row g-3">

    <?php while($product = mysqli_fetch_assoc($products)): ?>
    <div class="col-lg-3 col-md-4 col-6">
        <div class="card">
          <a href="product.php?productId=<?php echo $product["id"]; ?>">
            <img src="img/<?php echo $product["image"];?>.jpg" class="card-img-top" alt="...">
          </a>
          <div class="card-body">
            <h5 class="card-title my-1"><?php echo ucwords($product["name"]);?></h5>
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
            <a href="addProductToProfile.php?productId=<?php echo $product["id"]; ?>" class="btn btn-outline-primary mt-3">Satın al</a>
          </div>
        </div>
    </div>
    <?php endwhile; ?>

    </div>
  </div>

</section>
