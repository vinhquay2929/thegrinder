<?php
  include_once(__DIR__ . '/db_connect.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Menu</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
  <?php include_once(__DIR__ .'/layouts/styles.php'); ?>
</head>

<body>
<?php include_once(__DIR__ . '/layouts/partials/header.php'); ?>

  <main id="main" style="margin-top: 110px">
    <!-- ======= Menu Section ======= -->
    <section id="shopping" class="menu section-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Menu</h2>
          <p>Check Our Tasty Menu</p>
        </div>

        <div class="row" data-aos="fade-up" data-aos-delay="100">
          <div class="col-lg-12 d-flex justify-content-center">
            <ul id="menu-flters">
              <li data-filter="*" class="filter-active">All</li>
              <li data-filter=".filter-1">Coffees</li>
              <li data-filter=".filter-2">Macchiatos</li>
              <li data-filter=".filter-3">Teas</li>
              <li data-filter=".filter-4">Smoothies</li>
              <li data-filter=".filter-5">Cakes</li>
            </ul>
          </div>
        </div>

        <div class="row menu-container" data-aos="fade-up" data-aos-delay="200">

          <?php
          $query = 'SELECT id_p,name_p,pic,ingredient,price,id_k FROM product';
          $result = mysqli_query($dbc,$query);

          #Hiển thị danh sách sản phẩm
          while ($row = mysqli_fetch_array($result,1))
          {
            echo '<form method="post" action="cart.php?action=add&id='.$row['id_p'].'">
              <div class="col-md-4 menu-item filter-'.$row['id_k'].'">
              <img src="'.$row['pic'].'" class="menu-img">
              <div class="menu-content">
                <a href="#">'.$row['name_p'].'</a><span>'.number_format($row['price'], 0, '', '.').' VND</span>
              </div>
              <div class="menu-ingredients">
                '.$row['ingredient'].'

                <input style="
                  float:right;
                  width:100px;
                  background: #cda45e;
                  border: 0;
                  color: #fff;
                  transition: 0.4s;
                  border-radius: 20px;
                " type="submit" id="add" name="add" value="Add to cart">
              </div>
            </div>
            </form>';
          };
          mysqli_close($dbc);
        ?>     
       </div>
      </div>
    </section><!-- End Menu Section -->

  </main><!-- End #main -->
  <?php include_once(__DIR__ . '/layouts/partials/footer.php'); ?>
  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
  <?php include_once(__DIR__ . '/layouts/script.php');  ?>
</body>

</html>