

<?php 

  include "libs/functions.php";

  if(!isset($_COOKIE["type"])){
    header("Location: index.php");
    exit;
  }
  
  $categories = getCategories();

?>

<?php 
  require "views/_head-start.php";
  require "views/_message.php";
  require "views/_navbar.php";
?>

<div class="container my-5">

  <div class="card mb-3">
    <div class="card-body">
      <a href="category-create.php" class="btn btn-primary">Kategori Ekle</a>
    </div>
  </div>

  <table class="table table-hover table-bordered">
    <thead>
      <tr class="table-primary">
        <th style="width: 33px;">#</th>
        <th>Kategori</th>
        <th style="width: 136px;"></th>
      </tr>
    </thead>
    <tbody>
      <?php while($category = mysqli_fetch_assoc($categories)): ?>
      <tr>
        <th><?php echo $category["id"];?></th>
        <th><?php echo strtoupper($category["name"]);?></th>
        <th class="g-1">
          <a href="category-edit.php?categoryId=<?php echo $category["id"];?>" class="btn btn-primary btn-sm">Düzenle</a>
          <a href="category-delete.php?categoryId=<?php echo $category["id"];?>" class="btn btn-danger btn-sm">Sil</a>
        </th>
      </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
</div>






<?php 
  require "views/_head-finish.php";
?>