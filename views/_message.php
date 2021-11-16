

<?php if( isset($_SESSION["message"]) and isset($_SESSION["type"]) ): ?>

  <div class="alert alert-<?php echo $_SESSION["type"]; ?> text-center mb-0">

    <?php echo $_SESSION["message"]; ?>
    
    <!-- sessionların silinmesi -->
    <?php 
      unset($_SESSION["message"]);
      unset($_SESSION["type"]);
    ?>

  </div>

<?php endif; ?>  