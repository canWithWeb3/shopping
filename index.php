

<?php 

  include "libs/functions.php";


?>

<?php 
  require "views/_head-start.php";
  require "views/_message.php";
  require "views/_navbar.php";
?>

<?php 
  require "views/_slider.php";
?>

<?php 
  require "views/_product-list.php";
?>


<?php 
  require "views/_footer.php";
?>


<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
  $('.owl-carousel').owlCarousel({
    loop:true,
    margin:10,
    nav:false,
    dots:false,
    responsive:{
        0:{
            items:1
        }
    }
  })
</script>

<?php 
  require "views/_head-finish.php";
?>