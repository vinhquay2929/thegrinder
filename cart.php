<?php
    session_start();
    include_once(__DIR__ . '/db_connect.php');
  
    #Thêm sản phẩm vào giỏ hàng
    if(isset($_GET['action']) && $_GET['action']=="add")
    {
      $id = $_GET['id'];
      if(isset($_SESSION['cart'][$id]))
      {
        $_SESSION['cart'][$id]['quantity']++; 
        echo '<script>alert("Product is already in shopping cart! Updated product quantity.")</script>';
      }
      else
      {
        $query = "SELECT * FROM product WHERE id_p = $id";
        $result = mysqli_query($dbc,$query);
        $row = mysqli_fetch_assoc($result);
        $_SESSION['cart'][$id] = array(
          'id' => $id,
          'name' => $row['name_p'],
          'pic' => $row['pic'], 
          'quantity' => 1,
          'price' => $row['price']
        );
        echo '<script>alert("Product is add your shopping cart!")</script>';
      }
    }

    #Xoá một sản phẩm trong giỏ hàng
    if(isset($_GET['action']) && $_GET['action']=="delete")
    {
      foreach($_SESSION['cart'] as $id => $value)
      {
        if($id==$_GET['id'])
        {
          unset($_SESSION['cart'][$id]);
          echo '<script>alert("The product has been removed from your shopping cart!")</script>';
          break;
        }
      }
    }

    #Xoá hết sản phẩm trong giỏ hàng
    if(isset($_GET['action']) && $_GET['action']=="remove")
    {
      if(isset($_SESSION['cart']))
      {
        unset($_SESSION['cart']);
        echo '<script>alert("Your shopping cart has been cleared!")</script>';
      }
      else
      {
        echo '<script>alert("Your shopping cart is empty!")</script>';
      }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Cart</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
  <?php include_once(__DIR__ .'/layouts/styles.php'); ?>
</head>

<body>
<?php include_once(__DIR__ . '/layouts/partials/header.php'); ?>
  <!-- ======= Shopping cart ======= -->
    <main id="main" style="margin-top: 120px">
      <section id="shopping" class="cart section-bg">
        <div class="container" data-aos="fade-up">
        <div class="section-title">
          <h2>Shopping Cart</h2>
          <p>Shopping Cart</p>
        </div>

      <a href="menu.php" class="continue_shopping">< Continue Shopping</a>
    
      <div class="mt-5">
      <form action="payment.php" method="post">
        <div class="col-lg-12  cart_table">
        <table class="table table-hover">
        <thead>
          <tr>
            <th scope="col">STT</th>
            <th scope="col">PICTURE</th>
            <th scope="col">NAME</th>
            <th scope="col">QUANTITY</th>
            <th scope="col">PRICE</th>
            <th scope="col">AMOUNT</th>
            <th scope="col" style="text-align: center;">DELETE</th>
          </tr>
        </thead>
        <tbody>
          <?php 
            if(isset($_SESSION['cart']))
            {
              $i = 1;
              $total = 0;
              foreach($_SESSION['cart'] as $id => $value)
              {
                echo '
                  <tr>
                    <td style="padding: 10px;">'.$i.'</td>
                    <td><img src="'.$value['pic'].'" style="width: 50px;
                      border-radius: 50%;
                      border: 5px solid black;
                      float: center;"></td>
                    <td>'.$value['name'].'</td>
                    <td>'.$value['quantity'].'</td>
                    <td>'.number_format($value['price'], 0, '', '.').' VND</td>
                    <td >'.number_format($value['price']*$value['quantity'], 0, '', '.').' VND</td>
                    <td style="text-align: center;"><a href="cart.php?action=delete&id='.$id.'">X</a></td>
                  </tr>
                ';
                $i++;
                $total +=  $value['price']*$value['quantity'];
              }
              if($total !=0)
              {
                echo '<tr>
                  <td colspan="7" name="total"><h2>Subtotal: '.number_format($total,0,'','.').' VND</h2></td>
                </tr>';
              }
              else
              {
                echo '
                <tr>
                  <td colspan="7"><h1 style="text-align: center; font-size:60px;">Your shopping cart is empty.</h1></td>
                </tr>';
              }
            }
            else
                echo '
                <tr>
                  <td colspan="7"><h1 style="text-align: center; font-size:60px;">Your shopping cart is empty.</h1></td>
                </tr>';
          ?>
        </tbody>
      </table>
        </div>
        <br>
            <input type="submit" id="submit" value="PAYMENT" class="submit_payment">
            <a href="cart.php?action=remove&id='.$id.'" class="remove_all" >REMOVE ALL</a>
      </form>
      </div>
      </div>
    </section>   
  </main>
  <!-- ======= End shopping cart======= -->

  <?php include_once(__DIR__ . '/layouts/partials/footer.php'); ?>
  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
  <?php include_once(__DIR__ . '/layouts/script.php');  ?>
</body>

</html>