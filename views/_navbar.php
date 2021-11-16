<nav class="navbar navbar-expand-md navbar-light bg-light">
  <div class="container">
    <a class="navbar-brand" href="index.php"><i class="fas fa-shopping-bag text-warning fs-3 me-1"></i> Shopping</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">

      <!-- admin navbar -->
      <?php if(isset($_COOKIE["type"])): ?>
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="admin-products.php">Admin Ürünler</a>
        </li>
        <li class="nav-item">
           <a class="nav-link" href="admin-categories.php">Admin Kategoriler</a>
        </li>       
      </ul>
      <?php endif; ?>

      <!-- user navbar -->
      <?php if(!isset($_COOKIE["username"])): ?>
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="login.php">Giriş yap</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="register.php">Kayıt ol</a>
        </li>
      </ul>
      <?php else: ?>
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="logout.php">Çıkış yap</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="profile.php">Profilim, <?php echo $_COOKIE["username"]; ?></a>
        </li>
      </ul>
      <?php endif; ?> 
      <form class="d-flex" action="products.php">
        <input class="form-control me-2" name="q" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>

<nav class="navbar navbar-expand-md navbar-light bg-light mb-3">
  <div class="container">
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <?php $categories = getCategories(); ?>
      <?php foreach($categories as $category): ?>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo 'products.php?categoryId='.$category["id"]; ?>"><?php echo $category["name"]; ?></a>
        </li>
      <?php endforeach; ?>
      </ul>
    </div>
  </div>
</nav>