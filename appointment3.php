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

  //get menu table from db and put it in an array
  $menu_query = "select * from menu;";
  $menu_result = mysqli_query($conn, $menu_query);
  if ($menu_result === false) {
    echo mysqli_error($conn);
  } else {
    $menu_array = mysqli_fetch_all($menu_result, MYSQLI_ASSOC);
    //var_dump($menu_array);
  }

  $employee_query = "select * from employee;";
  $employee_result = mysqli_query($conn, $employee_query);
  if ($employee_result === false) {
    echo mysqli_error($conn);
  } else {
    $employee_array = mysqli_fetch_all($employee_result, MYSQLI_ASSOC);
    //var_dump($employee_array);
  }

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

  $employee_schedule_query = "select day_id from employee_schedule where employee_id = $emp_id;";
  $employee_schedule_result = mysqli_query($conn, $employee_schedule_query);
  if ($employee_schedule_result === false) {
    echo mysqli_error($conn);
  } else {
    $employee_schedule_array = mysqli_fetch_all($employee_schedule_result, MYSQLI_ASSOC);
    //var_dump($employee_schedule_array);
  }

  $time_id_query = "select * from time_id_list order by time_id;";
  $time_id_result = mysqli_query($conn, $time_id_query);
  if ($time_id_result === false) {
    echo mysqli_error($conn);
  } else {
    $time_id_array = mysqli_fetch_all($time_id_result, MYSQLI_ASSOC);
    //var_dump($time_id_array);
  }

  $appoint_duration_id_query = "select duration_id from menu where id = $menu_id;";
  $appoint_duration_id_result = mysqli_query($conn, $appoint_duration_id_query);
  if ($appoint_duration_id_result === false) {
    echo mysqli_error($conn);
  } else {
    $appoint_duration_id_array = mysqli_fetch_all($appoint_duration_id_result, MYSQLI_ASSOC);
    //var_dump($appoint_duration_id_array);
  }

  include 'include/header.php';
?>



<div class="appointment-div">
  <?php
    echo "<br><br>";
    echo "<h3>Service: <span style='color: #FAC39D;'>".$_SESSION['appoint_menu_name']."</span></h3>";
    echo "<br>";
    echo "<a class='btn' href='appointment1.php'>Change Service</a>";
    echo "<br><br><br>";
    echo "<h3>Cosmetologist: <span style='color: #FAC39D;'>".$_SESSION['appoint_employee_name']."</span></h3>";
    echo "<br>";
    echo "<a class='btn' href='appointment2.php'>Change Cosmetologist</a>";
  ?>
  <div id="go-to-choose-a-time-frame" class="section-title">
    <h2>3. Choose A Time Frame</h2>
  </div>
  <table class="appointment-table">
    <colgroup>
      <col span="1" style="background-color:#E4F9F5">
      <col span="1" style="background-color:none">
      <col span="1" style="background-color:#E4F9F5">
      <col span="1" style="background-color:none">
      <col span="1" style="background-color:#E4F9F5">
      <col span="1" style="background-color:none">
      <col span="1" style="background-color:#E4F9F5">
    </colgroup>
      <?php
        echo "<tr class='menu-row'>";
        $today_date = date('Y-m-d');
        $header_date = $tomorrow_date = date('Y-m-d', strtotime($today_date. '+ 1 days'));
        for ($i = 0; $i <= 6; $i++) {
          //echo $date."<br>";
          $day_id = date('w', strtotime($header_date));
          //echo $day_id."<br>";
          $day_of_week = $day_of_week_arry[$day_id];
          //echo $day_of_week."<br>";
          echo "<th><h3 class='slot-cell-content'>".$day_of_week."   ". substr($header_date, 5) ."</h3></th>";
          $header_date = date('Y-m-d', strtotime($header_date. '+ 1 days'));
        }
        echo "</tr>";
        $service_duration = $appoint_duration_id_array[0]['duration_id'];
        for ($j = 0; $j<=15; $j++) {
          $col_date = $tomorrow_date;
          echo "<tr class='menu-row'>";
            for ($i = 0; $i <= 6; $i++) {
              $day_id = date('w', strtotime($col_date));
              $is_working_day = false;
              $is_available = true;
              echo "<td class='slot-cell-content'>";
              foreach ($employee_schedule_array as $working_day){
                if(isset($working_day['day_id']) && $working_day['day_id'] == $day_id){
                  $is_working_day = true;
                }
              }
              foreach ($existing_appointment_array as $existing_appointment){
                if (isset($existing_appointment['start_date'])
                && $col_date == $existing_appointment['start_date']
                && isset($existing_appointment['start_time_id'])
                && ($time_id_array[$j]['time_id'] >= $existing_appointment['start_time_id']
                && $time_id_array[$j]['time_id'] < $existing_appointment['start_time_id'] + $existing_appointment['duration_id']
                || $time_id_array[$j]['time_id'] > $existing_appointment['start_time_id'] - $service_duration
                && $time_id_array[$j]['time_id'] <= $existing_appointment['start_time_id'])){
                  $is_available = false;
                }
              }
              if ($is_working_day == true && $is_available == true){
                echo "<form action='#go-to-choose-a-time-frame' method='post' id = 'slot-cell-form'>";
                echo "<input type='hidden' name='appointment_start_date' value =".$col_date.">";
                echo "<input type='hidden' name='appointment_start_time_id' value =".$time_id_array[$j]['time_id'].">";
                echo "<input type='hidden' name='appointment_start_time_str' value =".$time_id_array[$j]['time_str'].">";
                echo "<button id = 'active_slot_btn'>".$time_id_array[$j]['time_str']."</button>";
                echo "</form>";
                //echo "<h3>".$time_id_array[$j]['time_str']."</h3>";
              }
              $col_date = date('Y-m-d', strtotime($col_date. '+ 1 days'));
              echo "</td>";
            }
          echo "</tr>";
        }
      ?>
    </table>
    <?php
      if(isset($_POST['appointment_start_date']) && isset($_POST['appointment_start_time_id'])){
        $_SESSION['appointment_start_date'] = $_POST['appointment_start_date'];
        $_SESSION['appointment_start_time_id'] = $_POST['appointment_start_time_id'];
        $_SESSION['appointment_start_time_str'] = $_POST['appointment_start_time_str'];
        echo"<br>";
        echo "<h3>Visit Time: <span style='color: #FAC39D;'>".$_SESSION['appointment_start_date']." at ". $_SESSION['appointment_start_time_str'] . "</span></h3>";
        echo "<br>";
        echo "<a class='btn' href='appointment4.php'>One More Step To Secure Your Appointment</a>";
      }else{
        echo "<h3>Please Choose A Cosmetologist First.</h3>";
      }
    ?>
  <br><br><br><br><br><br>
</div>


<?php include 'include/footer.php'; ?>
