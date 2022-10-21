
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

  //get menu table from db and put it in an array
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



<div class="appointment-div">
  <div id="go-to-choose-a-service" class="section-title">
    <h2>1. Choose A Service</h2>
  </div>
  <table class="appointment-table">
    <?php
      $selected_service_index = -1;
      $selected_service_id = -1;
      for($i=0; $i<count($menu_array); $i++){
        echo "<tr class='menu-row'><td class='apointment-cell-title'><h3>" . $menu_array[$i]["name"]."</h3></td>";
        echo "<td class='apointment-cell-price'><h3>".$menu_array[$i]["duration"]." MIN". "   ".$menu_array[$i]["price"] . "$</h3></td>";
        echo "<form action='#go-to-choose-a-service' method='post'>";
        echo "<input type='hidden' name='appointment_service_index' value =".$i.">";
        echo "<td><button class='btn'>Select</button></td>";
        echo "</form>";
      }
    ?>
  </table>
    <?php
      if(isset($_POST['appointment_service_index'])){
        $selected_service_index = $_POST['appointment_service_index'];
        $selected_service_id = $menu_array[$selected_service_index]['id'];
      }
      echo"<br>";
      if ($selected_service_index >= 0){
        $_SESSION['appoint_menu_id'] = $selected_service_id;
        $_SESSION['appoint_menu_name'] = $menu_array[$selected_service_index]['name'];
        echo "<h3>Service: <span style='color: #FAC39D;'>".$_SESSION['appoint_menu_name']."</span></h3>";
        echo "<br>";
        echo "<a class='btn' href='appointment2.php'>Find A Cosmetologist</a>";
      }else{
        echo "<h3>Please Choose A Service First.</h3>";
      }
    ?>
  <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
</div>
<?php include 'include/footer.php'; ?>
