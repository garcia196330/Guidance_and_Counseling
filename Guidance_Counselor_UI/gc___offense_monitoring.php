<?php

  session_start();

    include_once("../connections/connection.php");

    if(!isset($_SESSION['UserEmail'])) {
        
        echo "<script>window.open('../homepage___login.php','_self')</script>";
        
    }else{

    $con = connection();

    $offense = "SELECT * FROM offense_monitoring";
    $get_offense = $con->query($offense) or die($con->error);
    $row = $get_offense->fetch_assoc();

    $date_created = $row['date_created'];
    $newDateCreated = date("F d, Y", strtotime($date_created));  

    // Sanction Days left
    $startDate = $row['start_date'];
    $endDate = $row['end_date'];
    $currentDate = date("Y-m-d");

    // End date + 1 day
    $endDate_original = strtotime($endDate);
    $date_add      = $endDate_original + (3600*24);
    $date_plus_one = date("Y-m-d", $date_add);

    if($startDate > $currentDate) {
      $diff = abs(strtotime($endDate) - strtotime($startDate));
      $years = floor($diff / (365*60*60*24));
      $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
      $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
      $sanction_info = ($days + 1) . " days left";
    } elseif($date_plus_one > $endDate) {
      // $sanction_info = "0 days left";
      $sanction_info = "Sanction Ended";
    } else {
      $diff = abs(strtotime($endDate) - strtotime($currentDate));
      $years = floor($diff / (365*60*60*24));
      $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
      $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
      $sanction_info = ($days + 1) . " days left";
    }

    if($sanction_info == "Sanction Ended") {
      $stat = "Inactive";
      $update_status_query = "UPDATE offense_monitoring SET status='$stat'";
      $stat_con = $con->query($update_status_query) or die($con->error);
    }

    if(isset($_POST['add_offense'])) {

      $id_number = $_POST['id_number'];
      $stud_name = $_POST['name'];
      $offense_type = $_POST['offense_type'];
      $description = $_POST['description'];
      $dateToday = date("Y-m-d");
      $sanction = $_POST['sanction'];
      $start_date = $_POST['start_date'];
      $end_date = $_POST['end_date'];
      $status = $_POST['status'];

      $offense_query = "INSERT INTO `offense_monitoring`(`student_id`,`stud_name`, `offense_type`, `description`, `date_created`, `sanction`, `sanction_info`, `status`) ".
              "VALUES ('$id_number','$stud_name','$offense_type','$description','$dateToday','$sanction','$start_date','$end_date','$status')";
              
      $query_run = $con->query($offense_query) or die($con->error);

      if ($query_run) {
        // echo "Saved";
        $_SESSION['status'] = "Offense Added";
        $_SESSION['status_code'] = "success";
        header('Location: gc___offense_monitoring.php');
      
        // echo "Not saved";
        $_SESSION['status'] = "Offense Not Added";
        $_SESSION['status_code'] = "error";
        header('Location: gc___offense_monitoring.php');
      }
    }

        
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
                  <li><span class="bread-blod">Offense Monitoring</span>
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

  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <div id="Add_New_Offense" class="modal modal-edu-general default-popup-PrimaryModal fade" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header header-color-modal bg-color-1">
            <h4 class="modal-title">Add New Student with Offense</h4>
            <div class="modal-close-area modal-close-df">
              <a class="close" data-dismiss="modal" href="#"><i class="fa fa-close"></i></a>
            </div>
          </div>

          <form action="" method="post">
            <div class="modal-body">
              <div class="form-group-inner">
                <div class="row">
                  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <label class="login2 pull-right">Student ID</label>
                  </div>
                  <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                    <input type="text" class="form-control" placeholder="Enter Student ID" name="id_number" />
                  </div>
                </div>
              </div>
              <div class="form-group-inner">
                <div class="row">
                  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <label class="login2 pull-right">Student Name</label>
                  </div>
                  <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                    <input type="text" class="form-control" placeholder="Enter Student Name" name="name" />
                  </div>
                </div>
              </div>
              <div class="form-group-inner">
                <div class="row">
                  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <label class="login2 pull-right pull-right-pro">Offense Type</label>
                  </div>
                  <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                    <div class="form-select-list">
                      <select class="form-control custom-select-value" name="offense_type">
                        <option value="" disabled>Offense Type</option>
                        <option>Offense A</option>
                        <option>Offense B</option>
                        <option>Offense C</option>
                        <option>Offense D</option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group-inner">
                <div class="row">
                  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <label class="login2 pull-right">Description</label>
                  </div>
                  <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                    <input type="text" class="form-control" placeholder="Enter Offense Description" name="description" />
                  </div>
                </div>
              </div>
              
              <!-- <div class="form-group-inner data-custon-pick" id="data_2">
                <div class="row">
                  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-9">
                    <label class="login2 pull-right" style="font-weight: bold;">Date</label>
                  </div>
                  <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                    <input type="date" class="form-control" name="date" />
                    <div class="input-group date ">
                      <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                      <input type="date" class="form-control" value="XX/XX/XXXX">
                    </div>
                  </div>
                </div>
              </div> -->

              <div class="form-group-inner">
                <div class="row">
                  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <label class="login2 pull-right">Sanction</label>
                  </div>
                  <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                    <input type="text" class="form-control" name="sanction" placeholder="Enter Saction" />
                  </div>
                </div>
              </div>
              <div class="form-group-inner data-custon-pick data-custom-mg" id="data_5">
                <div class="row">
                  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <label class="login2 pull-right" style="font-weight: bold;">Sanction Info</label>
                  </div>
                  <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                    <div class="input-daterange input-group" id="datepicker">
                      <input type="text" class="form-control" name="start_date" value="<?= date("m-d-Y"); ?>" />
                      <span class="input-group-addon">to</span>
                      <input type="text" class="form-control" name="end_date" value="<?= date("m-d-Y"); ?>" />
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group-inner">
                <div class="row">
                  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <label class="login2 pull-right pull-right-pro">Status</label>
                  </div>
                  <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                    <div class="form-select-list">
                      <select class="form-control custom-select-value" name="status">
                        <option>Active</option>
                        <option>Completed</option>
                        <option>Cancelled</option>
                        <option>Paused</option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary btn-md" data-dismiss="modal">Cancel</button>
              <button type="submit" name="add_offense" class="btn btn-primary btn-md">Submit</button>
            </div>
          </form>

        </div>
      </div>
    </div>

  </div>


  <!-- Static Table Start -->
  <div class="data-table-area mg-b-15">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="sparkline13-list">
            <div class="sparkline13-hd">
              <div class="main-sparkline13-hd">
                <h1>Offense <span class="table-project-n">Monitoring</span> Table</h1>
              </div>
            </div>
            <div class="sparkline13-graph">
              <div class="datatable-dashv1-list custom-datatable-overright">
                <div id="toolbar">
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Add_New_Offense">
                    Add New
                  </button>
                </div>
                <table id="table" data-toggle="table" data-pagination="true" data-search="true" data-show-columns="true" data-show-pagination-switch="true" data-show-refresh="true" data-key-events="true" data-show-toggle="true" data-resizable="true" data-cookie="true" data-cookie-id-table="saveId" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
                  <thead>
                    <tr>
                      <th data-field="name" >Student ID</th>
                      <th data-field="email">Name of Student</th>
                      <th data-field="phone" >Offense</th>
                      <th data-field="complete">Offense Description</th>
                      <th data-field="task" >Date</th>
                      <th data-field="date" >Sanction</th>
                      <th data-field="price" >Sanction Info</th>
                      <th data-field="status">Status</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php if ($row == 0) {
                          echo null;
                          } else {
                            do { ?>
                    <tr>
                      <td><b><?php echo $row['student_id'] ?></b></td>
                      <td><?php echo $row['stud_name'] ?></td>
                      <td><?php echo $row['offense_type'] ?></td>
                      <td><?php echo $row['description'] ?></td>
                      <td><?php echo $newDateCreated ?></td>
                      <td><?php echo $row['sanction'] ?></td>
                      <td><?php echo $sanction_info ?></td>
                      <td><?php echo $row['status'] ?></td>
                      <!-- <td>
                        <p class="btn btn-xs btn-success"><?php echo $row['status'] ?></p>
                      </td> -->
                    </tr>

                    <?php } while ($row = $get_offense->fetch_assoc()); } ?>

                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Static Table End -->

  </div>

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

<?php } ?>