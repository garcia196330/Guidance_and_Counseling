<?php

  session_start();

    include_once("../connections/connection.php");

    if(!isset($_SESSION['UserEmail'])) {
        
        echo "<script>window.open('../homepage___login.php','_self')</script>";
        
    }
$con = mysqli_connect("localhost", "root", "", "guidance_and_counseling");
     $query = "SELECT * FROM users WHERE role = 3";
    $execute = $con->query($query) or die($conn->error);
    $get = $execute->fetch_assoc();

        
?>


<!doctype html>
<html class="no-js" lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Guidance and Counseling - STI College Angeles</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- logo angeles_sti
        ============================================ -->
  <link rel="shortcut icon" type="image/x-icon" href="img/sti_logo.png">
  <!-- Google Fonts
    ============================================ -->
  <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700,900" rel="stylesheet">
  <!-- Bootstrap CSS
    ============================================ -->
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <!-- Bootstrap CSS
    ============================================ -->
  <link rel="stylesheet" href="css/font-awesome.min.css">
  <!-- owl.carousel CSS
    ============================================ -->
  <link rel="stylesheet" href="css/owl.carousel.css">
  <link rel="stylesheet" href="css/owl.theme.css">
  <link rel="stylesheet" href="css/owl.transitions.css">
  <!-- animate CSS
    ============================================ -->
  <link rel="stylesheet" href="css/animate.css">
  <!-- normalize CSS
    ============================================ -->
  <link rel="stylesheet" href="css/normalize.css">
  <!-- meanmenu icon CSS
    ============================================ -->
  <link rel="stylesheet" href="css/meanmenu.min.css">
  <!-- main CSS
    ============================================ -->
  <link rel="stylesheet" href="css/main.css">
  <!-- educate icon CSS
    ============================================ -->
  <link rel="stylesheet" href="css/educate-custon-icon.css">
  <!-- morrisjs CSS
    ============================================ -->
  <link rel="stylesheet" href="css/morrisjs/morris.css">
  <!-- mCustomScrollbar CSS
    ============================================ -->
  <link rel="stylesheet" href="css/scrollbar/jquery.mCustomScrollbar.min.css">
  <!-- metisMenu CSS
    ============================================ -->
  <link rel="stylesheet" href="css/metisMenu/metisMenu.min.css">
  <link rel="stylesheet" href="css/metisMenu/metisMenu-vertical.css">
  <!-- calendar CSS
    ============================================ -->
  <link rel="stylesheet" href="css/calendar/fullcalendar.min.css">
  <link rel="stylesheet" href="css/calendar/fullcalendar.print.min.css">
  <!-- datapicker CSS
    ============================================ -->
  <link rel="stylesheet" href="./css/datapicker/datepicker3.css">

  <!-- x-editor CSS
    ============================================ -->
  <link rel="stylesheet" href="css/editor/select2.css">
  <link rel="stylesheet" href="css/editor/datetimepicker.css">
  <link rel="stylesheet" href="css/editor/bootstrap-editable.css">
  <link rel="stylesheet" href="css/editor/x-editor-style.css">
  <!-- normalize CSS
    ============================================ -->
  <link rel="stylesheet" href="css/data-table/bootstrap-table.css">
  <link rel="stylesheet" href="css/data-table/bootstrap-editable.css">
  <!-- modals CSS
    ============================================ -->
  <link rel="stylesheet" href="./css/modals.css">

  <!-- style CSS
    ============================================ -->
  <link rel="stylesheet" href="style.css">
  <!-- responsive CSS
    ============================================ -->
  <link rel="stylesheet" href="css/responsive.css">
  <!-- modernizr JS
    ============================================ -->
  <script src="js/vendor/modernizr-2.8.3.min.js"></script>
</head>

<body>
  <?php include('includes/gc___left-menu-area.php') ?>
  <?php include('includes/gc___top-menu-area.php') ?>
  <?php include('includes/gc___mobile_menu.php')  ?>

  <div class="breadcome-area">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="breadcome-list single-page-breadcome">
            <div class="row">
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="breadcome-heading">

                </div>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <ul class="breadcome-menu">
                  <li><a href="#">Home</a> <span class="bread-slash">/</span>
                  </li>
                  <li><span class="bread-blod">Good Moral</span>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
  <?php include('includes/gc___mobile_menu.php')  ?>

        

        <form action="pupuntahan.php" method="POST">
            <table border="1">
                    <thead>
                    <tr>    
                            <th>
                            
                            </th>
                            <th>
                                ID
                            </th>
                            <th>
                                LastName
                            </th>
                            <th>
                                FirstName
                            </th>
                            <th>
                                Gender
                            </th>
                        </tr>
                    </thead>
                
                    <?php do{ ?>
                            <tr>
                                <td>
                                    <input type="checkbox" name="stu_name" value=" <?= $get['user_id'];?>">
                                </td>
                                <td>
                                   <?= $get['user_id'];?>
                                </td>
                                <td>
                                   <?= $get['last_name'];?>
                                </td>
                                <td>
                                   <?= $get['first_name'];?>
                                </td>
                                <td>
                                   <?= $get['gender'];?>
                                </td>
                            </tr>
                    <?php }while($get = $execute -> fetch_assoc()); ?>    
                    </thead>
                   
            </table>
            <input type="submit" name="submit" value="confirm">
        </form>



      

  

  

  <!-- jquery
    ============================================ -->
  <script src="js/vendor/jquery-1.12.4.min.js"></script>
  <!-- bootstrap JS
    ============================================ -->
  <script src="js/bootstrap.min.js"></script>
  <!-- wow JS
    ============================================ -->
  <script src="js/wow.min.js"></script>
  <!-- price-slider JS
    ============================================ -->
  <script src="js/jquery-price-slider.js"></script>
  <!-- meanmenu JS
    ============================================ -->
  <script src="js/jquery.meanmenu.js"></script>
  <!-- owl.carousel JS
    ============================================ -->
  <script src="js/owl.carousel.min.js"></script>
  <!-- sticky JS
    ============================================ -->
  <script src="js/jquery.sticky.js"></script>
  <!-- scrollUp JS
    ============================================ -->
  <script src="js/jquery.scrollUp.min.js"></script>
  <!-- mCustomScrollbar JS
    ============================================ -->
  <script src="js/scrollbar/jquery.mCustomScrollbar.concat.min.js"></script>
  <script src="js/scrollbar/mCustomScrollbar-active.js"></script>
  <!-- metisMenu JS
    ============================================ -->
  <script src="js/metisMenu/metisMenu.min.js"></script>
  <script src="js/metisMenu/metisMenu-active.js"></script>
  <!-- datapicker JS
    ============================================ -->
  <script src="js/datapicker/bootstrap-datepicker.js"></script>
  <script src="js/datapicker/datepicker-active.js"></script>
  <!-- morrisjs JS
    ============================================ -->
  <script src="js/sparkline/jquery.sparkline.min.js"></script>
  <script src="js/sparkline/jquery.charts-sparkline.js"></script>
  <!-- calendar JS
    ============================================ -->
  <script src="js/calendar/moment.min.js"></script>
  <script src="js/calendar/fullcalendar.min.js"></script>
  <script src="js/calendar/fullcalendar-active.js"></script>
  <!-- data table JS
    ============================================ -->
  <script src="js/data-table/bootstrap-table.js"></script>
  <script src="js/data-table/tableExport.js"></script>
  <script src="js/data-table/data-table-active.js"></script>
  <script src="js/data-table/bootstrap-table-editable.js"></script>
  <script src="js/data-table/bootstrap-editable.js"></script>
  <script src="js/data-table/bootstrap-table-resizable.js"></script>
  <script src="js/data-table/colResizable-1.5.source.js"></script>
  <script src="js/data-table/bootstrap-table-export.js"></script>
  <!--  editable JS
    ============================================ -->
  <script src="js/editable/jquery.mockjax.js"></script>
  <script src="js/editable/mock-active.js"></script>
  <script src="js/editable/select2.js"></script>
  <script src="js/editable/moment.min.js"></script>
  <script src="js/editable/bootstrap-datetimepicker.js"></script>
  <script src="js/editable/bootstrap-editable.js"></script>
  <script src="js/editable/xediable-active.js"></script>
  <!-- Chart JS
    ============================================ -->
  <script src="js/chart/jquery.peity.min.js"></script>
  <script src="js/peity/peity-active.js"></script>
  <!-- tab JS
    ============================================ -->
  <script src="js/tab.js"></script>
  <!-- plugins JS
    ============================================ -->
  <script src="js/plugins.js"></script>
  <!-- main JS
    ============================================ -->
  <script src="js/main.js"></script>
  <!-- tawk chat JS
    ============================================ -->
  <script src="js/tawk-chat.js"></script>
</body>

</html>

