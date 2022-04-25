<?php
  if(isset($_POST['send']))
  {
    $flag_1 = $flag_2 = $flag_3 = $flag_4 = 0;
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

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
    
    if($subject == '')
    {
      echo '<script>alert("Please enter your subject!!")</script>';
      $flag_2 = 0;
    }
    else
      $flag_2 = 1;

    if($message == '')
    {
      echo '<script>alert("Please enter your message!!")</script>';
      $flag_3 = 0;
    }
    else
      $flag_3 = 1;

    if($email == '')
    {
      echo '<script>alert("Please enter your email address!!")</script>';
      $flag_4 = 0;
    }
    else
    {
      if (!preg_match ("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+\.[A-Za-z]{2,6}$/", $email)) 
      {
        echo '<script>alert("Your email is invalid! Please enter a valid email address")</script>';
        $flag_4= 0;
      }
      else
        $flag_4 = 1;
    }

    if($flag_1 == 1 && $flag_2 == 1 && $flag_3 == 1 && $flag_4 == 1)
      echo '<script>alert("Your message has been sent. Thank you for contacting us.")</script>';
  }
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Grinder</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
  <?php include_once(__DIR__ .'/layouts/styles.php'); ?>
</head>

<body>
<?php include_once(__DIR__ . '/layouts/partials/header.php'); ?>
  
  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex align-items-center">
    <div class="container position-relative text-center text-lg-start" data-aos="zoom-in" data-aos-delay="100">
      <div class="row">
        <div class="col-lg-8">
          <h1>Welcome to <span>The Grinder</span></h1>
          <h2>Life is short - drink good coffee</h2>

          <div class="btns">
            <a href="menu.php" class="btn-menu animated fadeInUp scrollto">Our Menu</a>
          </div>
        </div>
      </div>
    </div>
  </section><!-- End Hero -->

  <main id="main">
    <!-- ======= About Section ======= -->
    <section id="about" class="about">
      <div class="container" data-aos="fade-up">
        <div class="row">
          <div class="col-lg-6 order-1 order-lg-2" data-aos="zoom-in" data-aos-delay="100">
            <div class="about-img">
              <img src="assets/img/bussy-coffee-shop.jpg" alt="">
            </div>
          </div>
          <div class="col-lg-6 pt-4 pt-lg-0 order-2 order-lg-1 content">
            <h3>The most worthy provide pleasure, as if pleasures of the body were to be taken.</h3>
            <p class="fst-italic">
            The pain itself is the love of the pain, the main ecological problems, but I give this kind of time to fall down, so that some great pain and pain.
            </p>
            <ul>
              <li><i class="bi bi-check-circle"></i> No school can work except to achieve the objectives from it.</li>
              <li><i class="bi bi-check-circle"></i> But the pain in the film is injurious to the pleasure it wants to condemn.</li>
              <li><i class="bi bi-check-circle"></i> No school can work except to achieve the objectives from it. The pain is to blame for the pleasure of the storacalaperda mastiro pain to escape from the pain no resultant.</li>
            </ul>
            <p>
            No school can work except to achieve the objectives from it. But the pain in the film is irure to condemn, in the pleasure it wants to escape from the pain of being clum in pain, none result. Those who crave blacks are the exception, they do not see, they are the ones who abandon their responsibilities in a fault that is soothing to the hardships
            </p>
          </div>
        </div>
      </div>
    </section><!-- End About Section -->

    <!-- Contact Section -->
    <section id="contact" class="contact">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Contact</h2>
          <p>Contact Us</p>
        </div>
      </div>

      <div data-aos="fade-up">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3928.851787489943!2d105.76792766024077!3d10.029086925284652!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31a0895a51d60719%3A0x9d76b0035f6d53d0!2sCan%20Tho%20University!5e0!3m2!1sen!2s!4v1649833663355!5m2!1sen!2s" width="1440" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>      
      </div>
      <div class="container" data-aos="fade-up"> 
        <div class="row mt-5">
          <div class="col-lg-4">
            <div class="info">
              <div class="address">
                <i class="bi bi-geo-alt"></i>
                <h4>Location:</h4>
                <p>3/2 Street, Ninh Kieu, Can Tho</p>
              </div>
 
              <div class="open-hours">
                <i class="bi bi-clock"></i>
                <h4>Open Hours:</h4>
                <p>
                  Monday-Saturday:<br>
                  08:00 AM - 23:00 PM
                </p>
              </div>

              <div class="email">
                <i class="bi bi-envelope"></i>
                <h4>Email:</h4>
                <p>thegrinder@gmail.com</p>
              </div>

              <div class="phone">
                <i class="bi bi-phone"></i>
                <h4>Call:</h4>
                <p>+84 916 773 523</p>
              </div>

            </div>
          </div>

          <div class="col-lg-8 mt-5 mt-lg-0">
            <form method="post" action="index.php" class="email-form">
              <div class="row">
                <div class="col-md-6 form-group">
                  <input type="text" name="name" class="form-control" id="name" placeholder="Enter your name.." required>
                </div>
                <div class="col-md-6 form-group mt-3 mt-md-0">
                  <input type="email" class="form-control" name="email" id="email" placeholder="Example: 123@gmail.com" required>
                </div>
              </div>
              <div class="form-group mt-3">
                <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required>
              </div>
              <div class="form-group mt-3">
                <textarea class="form-control" name="message" rows="8" placeholder="Message" required></textarea>
              </div>
              <hr>
              <div class="text-center"><button name="send">Send Message</button></div>
            </form>

          </div>

        </div>

      </div>
    </section><!-- End Contact Section -->

  </main><!-- End #main -->
  <?php include_once(__DIR__ . '/layouts/partials/footer.php'); ?>
  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
  <?php include_once(__DIR__ . '/layouts/script.php');  ?>
</body>

</html>