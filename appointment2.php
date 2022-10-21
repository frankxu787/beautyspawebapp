
<?php
  session_start();
  //var_dump($_SESSION);

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

  $employee_query = "select * from employee;";
  $employee_result = mysqli_query($conn, $employee_query);
  if ($employee_result === false) {
    echo mysqli_error($conn);
  } else {
    $employee_array = mysqli_fetch_all($employee_result, MYSQLI_ASSOC);
    //var_dump($employee_array);
  }
  include 'include/header.php';
?>



<div class="appointment-div">
  <?php
    echo "<br><br><h3>Service: <span style='color: #FAC39D;'>".$_SESSION['appoint_menu_name']."</span></h3>";
    echo "<br>";
    echo "<a class='btn' href='appointment1.php'>Change Service</a>";
  ?>
<div id="go-to-choose-a-cosmetologist" class="section-title">
  <h2>2. Choose A Cosmetologist</h2>
</div>
  <table class="appointment-table" style="width: 25%;">
    <?php
      $selected_employee_index = -1;
      $selected_employee_id = -1;
      for ($i=0; $i<count($employee_array); $i++) {
        echo "<tr class='menu-row'><td class='apointment-cell-employee_name'><h3>" . $employee_array[$i]["fname"]. " " . substr($employee_array[$i]["lname"], 0, 1). "</h3></td>";
        echo "<form action='#go-to-choose-a-cosmetologist' method='post'>";
        echo "<input type='hidden' name='appointment_employee_index' value =".$i.">";
        echo "<td><button class='btn'>Select</button></td>";
        echo "</form>";
      }
    ?>
  </table>
    <?php
      if(isset($_POST['appointment_employee_index'])){
        $selected_employee_index = $_POST['appointment_employee_index'];
        $selected_employee_id = $employee_array[$selected_employee_index]['id'];
      }
      echo"<br>";
      if ($selected_employee_index >= 0){
        $_SESSION['appoint_employee_id'] = $selected_employee_id;
        $_SESSION['appoint_employee_name'] = $employee_array[$selected_employee_index]['fname'] . " " . substr($employee_array[$selected_employee_index]['lname'], 0 , 1);
        echo "<h3>Cosmetologist: <span style='color: #FAC39D;'>".$_SESSION['appoint_employee_name']."</span></h3>";
        echo "<br>";
        echo "<a class='btn' href='appointment3.php'>Choose A Timeframe</a>";
      }else{
        echo "<h3>Please Choose A Cosmetologist First.</h3>";
      }
    ?>
  <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
</div>

<?php include 'include/footer.php'; ?>
