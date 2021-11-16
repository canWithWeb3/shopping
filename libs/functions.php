

<?php 

session_start();
function createUser(string $username,string $email,string $password){
  include "ayar.php";

  $query = "INSERT INTO users(username,email,password) VALUES (?, ?, ?)";
  $stmt = mysqli_stmt_init($connection);
  
  mysqli_stmt_prepare($stmt,$query);

  mysqli_stmt_bind_param($stmt, "sss", $username, $email, $password);
  $result = mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);

  return $result;
}

function getUserByUsername(string $username){
  include "ayar.php";

  $query = "SELECT * FROM users WHERE username='$username'";
  $result = mysqli_query($connection,$query);

  mysqli_close($connection);
  return $result;
}

function getUserByEmail(string $email){
  include "ayar.php";

  $query = "SELECT email FROM user WHERE email='$email'";
  $result = mysqli_query($connection,$query);

  mysqli_close($connection);
  return $result;
}













// Products

function productCreate(string $name, string $image, string $description, int $oldPrice, int $newPrice){
  include "ayar.php";

  $query = "INSERT INTO products(name,image,description,old_price,new_price) VALUES ('$name','$image','$description',$oldPrice,$newPrice)";
  $result = mysqli_query($connection,$query);

  mysqli_close($connection);
  return $result;
}

function getProducts(){
  include "ayar.php";

  $query = "SELECT * FROM products";
  $result = mysqli_query($connection,$query);

  mysqli_close($connection);
  return $result;
}

function getProductByProductId(int $productId){
  include "ayar.php";

  $query = "SELECT * FROM products WHERE id=$productId";
  $result = mysqli_query($connection,$query);

  mysqli_close($connection);
  return $result;
}

function productEdit(int $productId, string $name, string $image, string $description, float $oldPrice, float $newPrice){
  include "ayar.php";

  $query = "UPDATE products SET name='$name', image='$image', description='$description', old_price=$oldPrice, new_price=$newPrice WHERE id=$productId";
  $result = mysqli_query($connection,$query);

  mysqli_close($connection);
  return $result;
}

function getProductByProductName(string $name){
  include "ayar.php";

  $query = "SELECT * FROM products WHERE name='$name'";
  $result = mysqli_query($connection,$query);

  mysqli_close($connection);
  return $result;
}

function productDelete(int $productId){
  include "ayar.php";

  $query = "DELETE FROM products WHERE id=$productId";
  $result = mysqli_query($connection,$query);

  mysqli_close($connection);
  return $result;
}

function addProductToUserId($userId,$productId){
  include "ayar.php";

  $query = "INSERT INTO user_product(user_id,product_id) VALUES ($userId,$productId)";
  $result = mysqli_query($connection,$query);

  mysqli_close($connection);
  return $result;
}

function getProductsByUserId($userId){
  include "ayar.php";

  $query = "SELECT * FROM user_product up inner join products p on up.product_id=p.id WHERE up.user_id=$userId";
  $result = mysqli_query($connection,$query);

  mysqli_close($connection);
  return $result;
}













function getProductsByFilters($categoryId, $keyword, $page){
  include "ayar.php";

  $pageCount = 7;
  $offset = ($page-1) * $pageCount; 
  $query = "";

  if(!empty($categoryId)) {
      $query = "from product_category pc inner join products p on pc.product_id=p.id WHERE pc.category_id=$categoryId AND isActive=1";
  } else {
      $query = "from products p WHERE p.isActive=1";
  }

  if(!empty($keyword)) {
      $query .= " && p.name LIKE '%$keyword%'";
  }

  $total_sql = "SELECT COUNT(*) ".$query;

  $count_data = mysqli_query($connection, $total_sql);
  $count = mysqli_fetch_array($count_data)[0];
  $total_pages = ceil($count / $pageCount);

  $sql = "SELECT * ".$query." LIMIT $offset, $pageCount";
  $result = mysqli_query($connection, $sql);
  mysqli_close($connection);
  return array(
      "total_pages" => $total_pages,
      "data" => $result
  );
}






































// Categories

function getCategories(){
  include "ayar.php";

  $query = "SELECT * FROM categories";
  $result = mysqli_query($connection,$query);

  mysqli_close($connection);
  return $result;
}

function getCategoryByCategoryId(int $id){
  include "ayar.php";

  $query = "SELECT * FROM categories WHERE id=$id";
  $result = mysqli_query($connection,$query);

  mysqli_close($connection);
  return $result;
}

function categoryCreate(string $name){
  include "ayar.php";

  $query = "INSERT INTO categories(name) VALUES (?)";
  $stmt = mysqli_stmt_init($connection);

  mysqli_stmt_prepare($stmt,$query);

  mysqli_stmt_bind_param($stmt, "s", $name);
  $result = mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);

  return $result;
}

function categoryEdit(int $id, string $name){
  include "ayar.php";

  $query = "UPDATE categories SET name='$name' WHERE id=$id";
  $result = mysqli_query($connection,$query);

  mysqli_close($connection);
  return $result;
}

function categoryDelete(int $categoryId){
  include "ayar.php";

  $query = "DELETE FROM categories WHERE id=$categoryId";
  $result = mysqli_query($connection,$query);
  
  mysqli_close($connection);
  return $result;
}

function addCategoryToBlog(int $productId, array $categories){
  include "ayar.php";

  $query = "";
  foreach($categories as $category){
    $query .= "INSERT INTO product_category(product_id,category_id) VALUES ('$productId','$category');";
  }
  $result = mysqli_multi_query($connection,$query);

  mysqli_close($connection);
  return $result;
}

function getCategoriesByProductId(int $productId){
  include "ayar.php";

  $query = "SELECT * FROM product_category pc inner join categories c on pc.category_id=c.id WHERE pc.product_id=$productId";
  $result = mysqli_query($connection,$query);
  
  mysqli_close($connection);
  return $result;
}

function clearCategoriesByProductId(int $productId){
  include "ayar.php";

  $query = "DELETE FROM product_category WHERE product_category.product_id=$productId";
  $result = mysqli_query($connection,$query);
  
  mysqli_close($connection);
  return $result;
}







// User
function addProductToProfile($userId, $productId){
  include "ayar.php";

  $query = "INSERT INTO user_product(user_id,product_id) VALUES ($userId,$productId)";
  $result = mysqli_query($connection,$query);

  mysqli_close($connection);
  return $result;
}

function deleteProductToProfile($userId, $productId){
  include "ayar.php";

  $query = "DELETE FROM user_product WHERE user_product.product_id=$productId";
  $result = mysqli_query($connection,$query);

  mysqli_close($connection);
  return $result;
}

















function control_input($data) {
  $data = trim($data);
  // $data = strip_tags($data);
  $data = htmlspecialchars($data);
  // $title = htmlentities($data);
  $data = stripslashes($data); # sql injection

  return $data;
}

function kisaAciklama($aciklama, $limit) {
  if (strlen($aciklama) > $limit) {
      echo substr($aciklama,0,$limit)."...";
  } else {
      echo $aciklama;
  };
}

function saveImage($file) {
  $message = ""; 
  $uploadOk = 1;
  $fileTempPath = $file["tmp_name"];
  $fileName = $file["name"];
  $fileSize = $file["size"];
  $maxfileSize = ((1024 * 1024) * 1);
  $dosyaUzantilari = array("jpg","jpeg","png");
  $uploadFolder = "./img/";

  if($fileSize > $maxfileSize) {
      $message = "Dosya boyutu fazla.<br>";
      $uploadOk = 0;
  }

  $dosyaAdi_Arr = explode(".", $fileName);
  $dosyaAdi_uzantisiz = $dosyaAdi_Arr[0];
  $dosyaUzantisi = $dosyaAdi_Arr[1];

  if(!in_array($dosyaUzantisi, $dosyaUzantilari)) {
      $message .= "dosya uzantısı kabul edilmiyor.<br>";
      $message .= "kabul edilen dosya uzantıları : ".implode(", ", $dosyaUzantilari)."<br>";
      $uploadOk = 0;
  }

  $yeniDosyaAdi = md5(time().$dosyaAdi_uzantisiz).'.'.$dosyaUzantisi;
  $dest_path = $uploadFolder.$yeniDosyaAdi;

  if($uploadOk == 0) {
      $message .= "Dosya yüklenemedi.<br>";
  } else {
      if(move_uploaded_file($fileTempPath, $dest_path)) {
          $message .="dosya yüklendi.<br>";
      }
  }

  return array(
      "isSuccess" => $uploadOk,
      "message" => $message,
      "image" => $yeniDosyaAdi
  );
}
















?>