

<?php 
  include "libs/functions.php";

  $username = $email = $password = $repassword = "";
  $username_err = $email_err = $password_err = $register_err = "";
  
  if(isset($_POST["register"])){

    // control username
    if(empty($_POST["username"])){
      $username_err = "Username boş geçilemez";
    }else{
      $username = $_POST["username"];
    }

    // control email
    if(empty($_POST["email"])){
      $email_err = "Email boş geçilemez";
    }elseif(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
      $email_err = "Email standartlarına uymamaktadır";
    }elseif(strlen($_POST["email"]) > 260){
      $email_err = "Email 260 geçemez";
    }else{
      $email = $_POST["email"];
    }

    // control password
    if(empty($_POST["password"])){
      $password_err = "Parola boş geçilemez";
    }elseif($_POST["password"] != $_POST["repassword"]){
      $password_err = "Parolalar eşleşmiyor";
    }elseif(strlen($_POST["password"]) > 260){
      $email_err = "Parola 260 geçemez";
    }else{
      $password = $_POST["password"];
    }

    if(empty($username_err) && empty($email_err) && empty($password_err)){

      // username ve email kayıtta var mı?
      $usernameCheck = getUserByUsername($username);
      $emailCheck = getUserByEmail($email);

      if(mysqli_num_rows($usernameCheck)>0){
        $username_err = "Böyle bir kullanıcı adı var";
      }else{
        if(createUser($username,$email,$password)){
          $_SESSION["message"] = "Kayıt yapıldı";
          $_SESSION["type"] = "success";
          header("Location: index.php");
        }else{
          $email_err = "Böyle bir email var";
        }
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
  <div class="row">
    <div class="col-lg-7 col-md-10 col-12 mx-auto">
     <div class="card">
        <div class="card-header">
          <h5>Kayıt ol</h5>
        </div>
        <div class="card-body">
          <div class="fs-5 text-danger mb-3"><?php if(!empty($register_err)){echo $register_err;} ?></div>
          <form method="POST">

            <!-- register form username -->
            <div class="mb-3">
              <label for="username" class="form-label">Kullanıcı adı</label>
              <input type="text" name="username" id="username" 
              class="form-control <?php if(!empty($username_err)){echo "is-invalid";} ?>"
              value="<?php if(!empty($username)){echo $username;} ?>">
              <span class="invalid-feedback"><?php if(!empty($username_err)){echo $username_err;} ?></span>
            </div>

            <!-- register form email -->
            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input type="text" name="email" id="email" class="form-control <?php if(!empty($email_err)){echo "is-invalid";} ?>"
              value="<?php if(!empty($email)){echo $email;} ?>">
              <span class="invalid-feedback"><?php if(!empty($email_err)){echo $email_err;} ?></span>
            </div>

            <!-- register form password -->
            <div class="mb-3">
              <label for="password" class="form-label">Şifre</label>
              <input type="text" name="password" id="password" class="form-control <?php if(!empty($password_err)){echo "is-invalid";} ?>"
              value="<?php if(!empty($password)){echo $password;} ?>">
              <span class="invalid-feedback"><?php if(!empty($password_err)){echo $password_err;} ?></span>
            </div>

            <!-- register form repassword -->
            <div class="mb-3">
              <label for="repassword" class="form-label">Şifre tekrar</label>
              <input type="text" name="repassword" id="repassword" class="form-control"
              value="<?php if(!empty($repassword)){echo $repassword;} ?>">
            </div>

            <button type="submit" name="register" class="btn btn-primary">Kayıt ol</button>

          </form>

        </div>
      </div>
    </div>
  </div>
</div>















<?php 
  require "views/_head-finish.php";
?>