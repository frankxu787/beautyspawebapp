
<?php
  session_start();
  date_default_timezone_set("America/Los_Angeles");
  //var_dump($_SESSION);


  //db connection section
  $db_host = "localhost";
  $db_name = "avocadotreespa";
  $db_user = "avocado_admin";
  $db_pass = "j241@LbmPxQW_@2W";
  $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

  $emp_id = $_SESSION['appoint_employee_id'];
  $menu_id = $_SESSION['appoint_menu_id'];
  $day_of_week_arry = array('Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat');

  //connect to db
  if (mysqli_connect_error()) {
    echo mysqli_connect_error();
    echo "Database Connection Failed";
    exit;
  }
  //echo "Database Connected Successfully";

  $existing_appointment_query
  = "select A.start_date, A.start_time_id, M.duration_id
    from appointment A join menu M
    on A.menu_id = M.id
    where A.cancled = 0 and A.employee_id = $emp_id;";
  $existing_appointment_result = mysqli_query($conn, $existing_appointment_query);
  if ($existing_appointment_result === false) {
    echo mysqli_error($conn);
  } else {
    $existing_appointment_array = mysqli_fetch_all($existing_appointment_result, MYSQLI_ASSOC);
    //var_dump($existing_appointment_array);
  }

  include 'include/header.php';
?>

<div class="appointment-div">
  <div class="section-title">
    <h2>4. Summary</h2>
    <?php
      echo "<h3>Service: <span style='color: #FAC39D;'>".$_SESSION['appoint_menu_name']."</span></h3>";
      echo "<br>";
      echo "<a class='btn' href='appointment1.php'>Change Service</a>";
      echo "<br><br><br>";
      echo "<h3>Cosmetologist: <span style='color: #FAC39D;'>".$_SESSION['appoint_employee_name']."</span></h3>";
      echo "<br>";
      echo "<a class='btn' href='appointment2.php'>Change Cosmetologist</a>";
      echo "<br><br><br>";
      echo "<h3>Visit Time: <span style='color: #FAC39D;'>".$_SESSION['appointment_start_date']." at ". $_SESSION['appointment_start_time_str'] . "</span></h3>";
      echo "<br>";
      echo "<a class='btn' href='appointment3.php'>Change Time</a>";
    ?>
  </div>


  <div class="appointment-div">
    <div id="go-to-submission" class="section-title">
      <h2>5. Submission</h2>
    </div>
    <div class="contact-container">
      <form action="#go-to-submission" method="post">
        <?php echo "<h3>You are almost done, <span style='color: #FAC39D;'>" . $_SESSION['client_fname'].
        "</span>!</h3>"?>
        <h3>Submit with your (10-digit)phone#.</h3>
        <input class="contact-info" type="tel" pattern="[0-9]{3}[0-9]{3}[0-9]{4}" name="contact_phone">
        <button class = 'btn'>Submit</button>
        <br><br>
      </form>
      <?php
        if (isset($_POST['contact_phone']) && !empty($_POST['contact_phone'])){
          if ($_POST['contact_phone']==$_SESSION['client_phone']){
            //insert to database
            $new_appointment_query = "INSERT INTO appointment (menu_id, client_id, employee_id, start_date,
            start_time_id, cancled) VALUES ('".$_SESSION['appoint_menu_id']."','".$_SESSION['client_id']."',
            '".$_SESSION['appoint_employee_id']."', '".$_SESSION['appointment_start_date']."',
            '".$_SESSION['appointment_start_time_id']."', '0')";
            if(mysqli_query($conn, $new_appointment_query)){
              echo "<br><h2 style='color: #FAC39D; margin-bottom: 0px;'>Submission Successful!</h2>";
              echo "<h3 style='color: #FAC39D;'>We are looking forward to your upcoming visit!</h3>";
            }else{
              echo "<br><h2 style='color: #F89E95; margin-bottom: 0px;'>Ooops, something is wrong. </h2>";
              echo "<br><h3 style='color: #F89E95; margin-bottom: 0px;'>We're sorry for the inconvenience, please try again.</h3>";
            }
          } else {
            echo "<h3 style='color: #F89E95;'>Phone# does NOT match, please try again.</h3>";
          }
        }
        echo "<br><br><a class='btn' href='home.php'>Go Back To Homepage</a><br><br><br>";
      ?>
    </div>
    <br><br><br><br><br><br><br>
  </div>

  <?php include 'include/footer.php'; ?>
