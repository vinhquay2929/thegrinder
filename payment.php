<?php
  session_start();
  include_once(__DIR__ . '/db_connect.php');

  if(isset($_POST['accept']))
  {
    $flag_1 = $flag_2 = $flag_3 =0;
    $id_cart = rand(0,100);
    $total = 0;
    foreach($_SESSION['cart'] as $id => $value)
      $total += $value['quantity'] * $value['price'];                
    $number = $_POST['number-phone'];
    $name = $_POST['name-customer'];
    $address = $_POST['address'];
    $date = date("Y-m-d H:i:s");
    $card_number = $_POST['number-card'];

    if($name == '')
    {
        echo '<script>alert("Pleaser enter your name!!")</script>';
        $flag_1 = 0;
    }
    else
    {
        if(!preg_match("/^[a-zA-Z-' ]*$/",$name))
        {
            echo '<script>alert("Only letters and white space allowed!!")</script>';
            $flag_1 = 0;
        }
        else
            $flag_1 = 1;
    }

    if($number == '')
    {
      echo '<script>alert("Please enter a phone number!!")</script>';
      $flag_2 = 0;
    }
    else
        {
        if(strlen($number) != 10)
        {
            echo '<script>alert("Please enter a phone number with 10 digits!!")</script>';
            $flag_2 = 0;
        }
        else
        {
            if(!preg_match("/^[0-9]*$/", $number))
            {
                echo '<script>alert("Invalid phone number!!")</script>';
                $flag_2 = 0;
            }
            else
                $flag_2 = 1;
        }
        }

    
    if($card_number == '')
    {
        echo '<script>alert("Please enter a card number!!")</script>';
        $flag_3 = 0;
    }
    else
    {
        if(strlen($card_number) != 12)
        {
            echo '<script>alert("Please enter a card number with 12 digits!!")</script>';
            $flag_3 = 0;
        }
        else
        {
            if(!preg_match("/^[0-9]*$/", $card_number))
            {
                echo '<script>alert("Invalid card number!!")</script>';
                $flag_3 = 0;
            }
            else
                $flag_3 = 1;
        }
    }

    if($flag1 == 1 && $flag2 == 1 && $flag3 == 1)
    {
      if(isset($_SESSION['cart']))
      {
        $query = "INSERT INTO order_customer(id_order,number_customer, name_customer, date_order, address_customer, card_customer, total) VALUES ('${id_cart}','${number}','${name}','${date}','${address}','${card_number}' ,'${total}')";
        $result = mysqli_query($dbc,$query);
        if($result)
        {
          foreach($_SESSION['cart'] as $id => $value)
          {
            $name_product = $value['name'];
            $quantity = $value['quantity'];
            $price = $value['price'];
            $id_product = $value['id'];
            $query_2 = "INSERT INTO detail_order(name_product, quantity, price_product, id_order, id_p) VALUES ('${name_product}','${quantity}','${price}','${id_cart}','${id_product}')";
            mysqli_query($dbc,$query_2);
          }
          echo '<script>alert("Successful payment!!!!")</script>';
          unset($_SESSION['cart']);
        }
        else
          echo '<script>alert("Payment failed!!!! ERROR: '.$query.'")</script>';
      }
      else
        echo '<script>alert("Your shopping cart is empty!! You need choose product, what you like.")</script>';
    }
  }
  
  #Xoá một sản phẩm trong giỏ hàng
  if(isset($_GET['action']) && $_GET['action']=="delete")
    foreach($_SESSION['cart'] as $id => $value)
      if($id==$_GET['id'])
      {
        unset($_SESSION['cart'][$id]);
        echo '<script>alert("The product has been removed from your shopping cart!")</script>';
        break;
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

  <title>Payment</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
  <?php include_once(__DIR__ .'/layouts/styles.php'); ?>
</head>

<body>
<?php include_once(__DIR__ . '/layouts/partials/header.php'); ?>
  <!-- ======= Payments ======= -->
    <main id="main" style="margin-top: 120px">
      <section id="shopping" class="payment section-bg">
        <div class="container" data-aos="fade-up">
          <div class="section-title">
            <h2>Payment</h2>
            <p>Payment</p>
          </div>
        <a href="cart.php" class="continue_shopping">< Back</a>

        <!-- ======= Thong tin gio hang======= -->
          <div class="row mt-5 payments">
          <div class="col-lg-8">
            <div class="form_payment_info">
              <table class="table table-hover" style="margin-top: 27px;">
                  <thead>
                      <tr>
                        <th colspan="4"><h1>Order Details</h1> <br> 
                          <p style="text-align: left;">Staff: Thang - Vinh</p> 
                          <p style="text-align: left;">Date: <?php echo date("Y-m-d H:i:s");?></p> 
                        </th>
                      </tr>
                      <tr>
                        <th scope="col">Unit Price</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Delete</th>
                      </tr>
                  </thead>
                  <tbody>
                      <?php
                      $total = 0;
                      foreach($_SESSION['cart'] as $id => $value)
                      {
                        if($_SESSION['cart'])
                        {
                          echo '
                            <tr>
                              <td>'.$value['name'].'<br>'.number_format($value['price'], 0, '', '.').' VND</td>
                              <td>'.$value['quantity'].'</td>
                              <td>'.number_format($value['price']*$value['quantity'], 0, '', '.').' VND</td>
                              <td><a href="payment.php?action=delete&id='.$id.'" style="color: black;">X</a></td>
                            </tr>
                          ';
                          $total += $value['quantity'] * $value['price'];
                        }
                      }
                      echo '
                      <tr >
                        <td colspan="4" style="text-align: left;"><h3>Subtotal: '.number_format($total,0,'','.').' VND
                        <br> Shipping fees: FREE
                        <br> Total (including shipping fees): '.number_format($total,0,'','.').' VND</h3></td>
                      </tr>';
                      ?>
                  </tbody>
              </table>
              <a href="payment.php?action=remove&id='.$id.'" class="remove_all_payment" >REMOVE ALL</a>
            </div>
          </div>
        <!-- ======= Hết thông tin giỏ hàng ======= -->

        <!-- ======= Thông tin khách hàng ======= -->
          <div class="col-lg-4 mt-3 mt-lg-1">
          <form method="post" action="payment.php" class="form_payment">
              <h2 style="text-align:center;">Customer Details</h2>
              <div class="row">
                <div class="col-mt-3 form-group">
                <label class="title_form">Full Name</label>
                  <input type="text" name="name-customer" class="form-control" style="border-radius: 10px;" placeholder="Enter your name...">
                </div>
              </div>
              <div class="form-group mt-3">
              <label class="title_form">Number Phone</label>
                <input type="text" class="form-control" name="number-phone" style="border-radius: 10px;" placeholder="Enter your number phone...">
              </div>
              <div class="form-group mt-3">
              <label class="title_form">Address</label>
                <textarea class="form-control" name="address" style="border-radius: 10px;" rows="3" placeholder="Enter your address..."></textarea>
                <input type="hidden" name="total" value="<?php $total ?>">
                <br>
              </div>
              <hr>

              <h2 style="text-align:center;">Payment Details</h2>
              <div class="row">
                <div class="col-mt-3 form-group">
                  <label class="title_form">Card Number</label>
                  <input type="text" name="number-card" class="form-control" style="border-radius: 10px;" placeholder="Enter your card number...">
                </div>
              </div>

              <div class="row">
                <div class="col-md-4 form-group">
                  <label class="title_form">Month</label>
                  <input type="number" name="month" class="form-control" style="border-radius: 10px;" placeholder="MM" min="1" max="12">
                </div>
                <div class="col-md-4 form-group">
                  <label class="title_form">Year</label>
                  <input type="number" name="year" class="form-control" min="2022" style="border-radius: 10px;" placeholder="YYYY">
                </div>
                <div class="col-md-4 form-group">
                  <label class="title_form">CVV</label>
                  <input type="number" name="cvv" class="form-control" minlength="3" maxlength="3" style="border-radius: 10px;" placeholder="123">
                </div>
              </div>

              <hr>
              <div class="text-center"><button name="accept">Make Payment</button>
                </div>
            </form>
          <!-- ======= Hết thông tin khách hàng ======= -->
    
          </div>
        </div>
        </div>
        </section>   
    </main>
  <!-- ======= End payments ======= -->
  <?php include_once(__DIR__ . '/layouts/partials/footer.php'); ?>
  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
  <?php include_once(__DIR__ . '/layouts/script.php');  ?>
</body>

</html>