

<?php 

  include "libs/functions.php";

  if(!isset($_COOKIE["type"])){
    header("Location: index.php");
    exit;
  }
  
  $products = getProducts();
?>

<?php 
  require "views/_head-start.php";
  require "views/_message.php";
  require "views/_navbar.php";
?>

<div class="container my-5">

  <div class="card mb-3">
    <div class="card-body">
      <a href="product-create.php" class="btn btn-primary">Ürün Ekle</a>
    </div>
  </div>

  <table class="table table-hover table-bordered">
    <thead>
      <tr class="table-primary">
        <td style="width: 33px;">#</td>
        <td style="width: 13px;">Resim</td>
        <td style="width: 246px;">Ürünün Adı</td>
        <td style="width: 13px;">Fiyatı</td>
        <td style="width: 33px;">Kategorisi</td>
        <td style="width: 73px;"></td>
      </tr>
    </thead>
    <tbody>
      
      <?php while($product = mysqli_fetch_assoc($products)): ?>
        <tr>
          <th><?php echo $product["id"];?></th>
          <th><img src="img/<?php echo $product["image"];?>.jpg" class="img-fluid" alt=""></th>
          <th><?php echo $product["name"];?></th>
          <th><?php echo $product["new_price"];?></th>
          <th>
            <?php $productCategories = getCategoriesByProductId($product["id"]); ?>
            <?php echo "<ul class='m-0 p-0 list-unstyled'>"; ?>
            <?php while($productCategory = mysqli_fetch_assoc($productCategories)): ?>
              <?php echo '<li class="m-0 p-0">'.$productCategory["name"].'</li>'; ?>
            <?php endwhile; ?>  
            <?php echo "</ul>"; ?>
          </th>
          <th>
            <a href="product-edit.php?productId=<?php echo $product["id"];?>" class="btn btn-primary btn-sm">Düzenle</a>
            <a href="product-delete.php?productId=<?php echo $product["id"];?>" class="btn btn-danger btn-sm">Sil</a>
          </th>
        </tr>
      <?php endwhile;?>

    </tbody>
  </table>
</div>






<?php 
  require "views/_head-finish.php";
?>