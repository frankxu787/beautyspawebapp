<?php
  session_start();
  session_destroy();
  session_start();

  //db connection section
  $db_host = "localhost";
  $db_name = "avocadotreespa";
  $db_user = "avocado_admin";
  $db_pass = "j241@LbmPxQW_@2W";
  $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

  //connect to db
  if (mysqli_connect_error()) {
    echo mysqli_connect_error();
    echo "Database Connection Failed";
    exit;
  }
  //echo "Database Connected Successfully";

  $menu_query = "select * from menu;";
  $menu_result = mysqli_query($conn, $menu_query);
  if ($menu_result === false) {
    echo mysqli_error($conn);
  } else {
    $menu_array = mysqli_fetch_all($menu_result, MYSQLI_ASSOC);
    //var_dump($menu_array);
  }

  include 'include/header.php';
?>

  <div id="go-to-home" class="container-poster">
    <img class="image-poster" src="image/facial_image_3.jpg" alt="poster image">
  </div>



  <div class="container-main">
    <h1>Avocado Tree Spa</h1>
    <h2>Welcome To The House Of Beauty.</h2>
    <div class="div-nevbar">
      <table class="table-nev">
        <tr>
          <th>
            <a class="btn" href="#go-to-about">About</a>
          </th>
          <th>
            <a class="btn" href="#go-to-menu">Menu</a>
          </th>
          <th>
            <a class="btn" href="#go-to-appointment">Appointment</a>
          </th>
          <th>
            <a class="btn" href="#go-to-contact">Contact Us</a>
          </th>
        </tr>
      </table>
    </div>
  </div>



  <div id="go-to-about" class="container-about">
    <div class="section-title">
      <h2>About</h2>
    </div>
    <table class="about-table">
      <tr>
        <th id="about-cell">
          <h3>The Avocado Tree Spa<br>Since 2002</h3>
          <img src="image/brand.png" alt="brand image" id="brand">
          <p class="about-text">
            Facial treatment can give you bright, glowing,
            <br>
            rejuvenated skin-perfect for a pre-event
            <br>
            confidence boost or as a regular treat.
            <br>
            Whether you need dead skin removing,
            <br>
            anti-aging treatment or a blast of hydration,
            <br>
            Avocado Tree Spa will always provide you
            <br>
            the top tier quality treatment.
          </p>
        </th>
        <th>
          <table>
            <tr>
              <th>
                <img class="about_img" src="image/about_image_1.jpg" alt="about-1">
              </th>
              <th>
                <img class="about_img" src="image/about_image_4.jpg" alt="about-2">
              </th>
            </tr>
            <tr>
              <th>
                <img class="about_img" src="image/about_image_3.jpg" alt="about-3">
              </th>
              <th>
                <img class="about_img" src="image/about_image_2.png" alt="about-4">
              </th>
            </tr>
          </table>
        </th>
      </tr>
    </table>
  </div>



  <div id = "go-to-menu" class="container-menu">
    <div class="section-title">
      <h2>Menu</h2>
    </div>
    <table class="menu-table">
      <?php for($i=0; $i<count($menu_array); $i++): ?>
        <tr class="menu-row">
          <?php if($i%2 == 0):?>
            <th class="menu-cell">
              <img class="menu-image-left" src=<?php echo $menu_array[$i]["image_address"]?> alt="menu_image">
            </th>
            <th class="menu-cell">
              <h3><?php echo $menu_array[$i]["name"]?></h3>
              <p><?php echo $menu_array[$i]["description"]?></p>
              <h3><?php echo "Duration: " . $menu_array[$i]["duration"] . " MIN"?></h3>
              <h3><?php echo "Price: $" . $menu_array[$i]["price"]?></h3>
            </th>
          <?php else:?>
            <th class="menu-cell">
              <h3><?php echo $menu_array[$i]["name"]?></h3>
              <p><?php echo $menu_array[$i]["description"]?></p>
              <h3><?php echo "Duration: " . $menu_array[$i]["duration"] . " MIN"?></h3>
              <h3><?php echo "Price: $" . $menu_array[$i]["price"]?></h3>
            </th>
            <th class="menu-cell">
              <img class="menu-image-right" src=<?php echo $menu_array[$i]["image_address"]?> alt="menu_image">
            </th>
          <?php endif; ?>
        </tr>
      <?php endfor; ?>
    </table>
  </div>



  <div id = "go-to-appointment" class="container-appointment">
    <div class="section-title">
      <h2>Appointment</h2>
    </div>
    <div class="contact-container">
      <form action="#go-to-appointment" method="post">
        <h3>Use Your Email To Book</h3>
        <input class="contact-info-email" type="email" name="contact_email">
        <button class = 'btn'>Next</button>
        <br><br>
      </form>
      <?php
      if (isset($_POST['contact_email']) && !empty($_POST['contact_email'])){
        $client_query = "select * from client;";
        $client_result = mysqli_query($conn, $client_query);
        if ($client_result === false) {
          echo mysqli_error($conn);
        } else {
          $client_array = mysqli_fetch_all($client_result, MYSQLI_ASSOC);
          //echo var_dump($client_array);
        }
        $is_existing_client = false;
        foreach ($client_array as $client){
          if(isset($client['email']) && $client['email'] == $_POST['contact_email']){
            $is_existing_client = true;
            $_SESSION['client_id'] = $client['id'];
            $_SESSION['client_fname'] = $client['fname'];
            $_SESSION['client_lname'] = $client['lname'];
            $_SESSION['client_phone'] = $client['phone'];
            $_SESSION['client_email'] = $client['email'];
            break;
          }
        }
        if ($is_existing_client == true) {
          echo "<h3>Welcome back, <span style='color: #FAC39D;'>".$_SESSION['client_fname']. "</span>!</h3>";
          echo "<h4>Please confirm the last 4 of your phone# below:</h4>";
          echo "<h3><span style='color: #FAC39D;'>(***) ***-". substr($_SESSION['client_phone'], 6) . "</span></h3>";
          echo "<h4>If this is not you, please enter another email</h4>";
          echo "<br><a class='btn' href='appointment1.php'>Make An Appointment</a>";
        } else {
          echo "<h3>The Email, <span style='color: #F89E95;'>". $_POST['contact_email'] . "</span>, is NOT recognized.</h3>";
          echo "<h4>For new clients, please contact us for initial skin assessment.</h4>";
          echo "<h4>The contact information are listed below.</h4>";
          echo "<br>";
        }
      }
      ?>
    </div>
    <br><br><br>
  </div>



  <div id = "go-to-contact" class="container-contact">
    <div class="section-title">
      <h2>Contact Us</h2>
    </div>
    <h1 style="font-size:50px;">Avocado Tree Spa</h1>
    <h3>Tel: (562) 458-5447</h3>
    <h3>Address: 887 Habor Rd., Long Beach, CA 91700</h3>
    <h3>Hours: 10am-6pm Mon-Sun</h3>
    <h3>Email: avocadotree@gmail.com</h3>
    <h3>Instagram: avocado_beauty</h3>
    <h3>Twitter: @avocado_tree</h3>
    <br><br>
    <a class="btn" href="#go-to-home">Home</a>
    <br><br><br>
  </div>


<?php include 'include/footer.php'; ?>
