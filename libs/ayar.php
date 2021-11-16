

<?php 

  $server3 = "127.0.0.1";
  $username3 = "root";
  $password3 = "";
  $database3 = "shopping";

  $connection = mysqli_connect($server3,$username3,$password3,$database3);
  mysqli_set_charset($connection,"UTF8");

  if(mysqli_connect_errno()>0){
    die("error: ".mysqli_connect_errno());
  }

?>