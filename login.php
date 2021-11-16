

<?php 
  include "libs/functions.php";

  $username = $email = $password = "";
  $username_err = $email_err = $password_err = $login_err = "";
  
  if(isset($_POST["login"])){

    // control username
    if(empty($_POST["username"])){
      $username_err = "Username boş geçilemez";
    }else{
      $username = $_POST["username"];
    }

    // control password
    if(empty($_POST["password"])){
      $password_err = "Parola boş geçilemez";
    }else{
      $password = $_POST["password"];
    }

    if(empty($username_err) && empty($password_err)){
      
        $userResult = getUserByUsername($username);
        // Kayıt var mı?
        if(mysqli_num_rows($userResult)==1){
          $user = mysqli_fetch_assoc($userResult);
          // Giriş kontrolü
          if($user["username"]==$username and $user["password"]==$password){

            // admin girişi mi?
            if($user["user_type"] == "admin"){
              setcookie("type","admin", time() + (36400*30));
              setcookie("username",$user["username"], time() + (36400*30));
              header("Location: index.php");
            }else{
              setcookie("username",$user["username"], time() + (36400*30));
              header("Location: index.php");
            }

          }else{
            $_SESSION["message"] = "Kontrol ediniz";
            $_SESSION["type"] = "danger";
          }
        }else{
          $_SESSION["message"] = "Kontrol ediniz";
          $_SESSION["type"] = "danger";
        }
        
      
    }else{
      echo "hata";
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
          <h5>Giriş yap</h5>
        </div>
        <div class="card-body">
          <div class="fs-3 text-danger"><?php if(!empty($login_err)){echo $login_err;} ?></div>
          <form action="login.php" method="POST">

            <!-- login form username -->
            <div class="mb-3">
              <label for="username" class="form-label">Kullanıcı adı</label>
              <input type="text" name="username" id="username" 
              class="form-control <?php if(!empty($username_err)){echo "is-invalid";} ?>"
              value="<?php if(!empty($username)){echo $username;} ?>">
              <span class="invalid-feedback"><?php if(!empty($username_err)){echo $username_err;} ?></span>
            </div>

            <!-- login form password -->
            <div class="mb-3">
              <label for="password" class="form-label">Şifre</label>
              <input type="text" name="password" id="password" class="form-control <?php if(!empty($password_err)){echo "is-invalid";} ?>"
              value="<?php if(!empty($password)){echo $password;} ?>">
              <span class="invalid-feedback"><?php if(!empty($password_err)){echo $password_err;} ?></span>
            </div>

            <a href="#" class="d-block">Şifrenizi mi unuttunuz?</a>

            <button type="submit" name="login" class="btn btn-primary mt-3">Giriş yap</button>

          </form>

        </div>
      </div>
    </div>
  </div>
</div>















<?php 
  require "views/_head-finish.php";
?>