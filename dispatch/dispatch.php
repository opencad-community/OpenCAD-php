<?php
    session_start();

    // TODO: Verify user has permission to be on this page
	
    if (empty($_SESSION['logged_in']))
    {
        header('Location: ../index.php');
        die("Not logged in");
    }
    else
    {
      $name = $_SESSION['name'];
    }

    $iniContents = parse_ini_file("../properties/config.ini", true); //Gather from config.ini file
    $community = $iniContents['strings']['community'];

    include("../actions/api.php");

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php echo $community;?> Dispatcher</title>
    <link rel="icon" href="../images/favicon.ico" />

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Datatables -->
    <link href="../vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
    <link href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" rel="Stylesheet"></link>
    

    <!-- Custom Theme Style -->
    <link href="../css/custom.css" rel="stylesheet">
  </head>
  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="javascript:void(0)" class="site_title"><i class="fa fa-tachometer"></i> <span><?php echo $community;?> Dispatch</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="../images/user.png" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2><?php echo $name;?></h2>
              </div>
              <div class="clearfix"></div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  <li class="active"><a><i class="fa fa-home"></i> Home <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu" style="display: block;">
                      <li class="current-page"><a href="javascript:void(0)">Dashboard</a></li>
                    </ul>
                  </li>
                </ul>
              </div>
              <!-- ./ menu_section -->
            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen" onclick="toggleFullScreen()">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="../actions/logout.php">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="../images/user.png" alt=""><?php echo $name;?>
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="https://github.com/ossified/openCad/issues">Help</a></li>
                    <li><a href="../actions/logout.php"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                  </ul>
                </li>

                
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>CAD Dispatcher</h3>
              </div>
              <!-- ./ title_left -->
            </div>
            <!-- ./ page-title -->

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Command Line Interface</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                      <li><a data-toggle="modal" href="#quickGuide"><i class="fa fa-question-circle"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <!-- ./ x_title -->
                  <div class="x_content">
                      <div class="col-md-12">
                        <div class="input-group">
                            <input type="text" name="cli" class="form-control" id="cli"/>
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-primary">Send</button>
                            </span>
                        </div>
                        <!-- ./ input-group -->
                      </div>
                      <!-- ./ col-md-12 -->
                  </div>
                  <!-- ./ x_content -->
                </div>
                <!-- ./ x_panel -->
              </div>
              <!-- ./ col-md-12 col-sm-12 col-xs-12 -->
            </div>
            <!-- ./ row -->

            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Active Calls</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <!-- ./ x_title -->
                  <div class="x_content">
                      <?php //getActiveCalls();?>
                      <div class="alert alert-info"><span>No active calls</span></div>
                  </div>
                  <!-- ./ x_content -->
                  <div class="x_footer">
                    <button class="btn btn-primary" name="new_call_btn" data-toggle="modal" data-target="#newCall">New Call</button>
                  </div>
                </div>
                <!-- ./ x_panel -->
              </div>
              <!-- ./ col-md-12 col-sm-12 col-xs-12 -->
            </div>
            <!-- ./ row -->

            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-4 col-sm-4 col-xs-4">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Dispatchers</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <!-- ./ x_title -->
                  <div class="x_content">
                      <?php getDispatchers();?>
                  </div>
                  <!-- ./ x_content -->
                </div>
                <!-- ./ x_panel -->
              </div>
              <!-- ./ col-md-2 col-sm-2 col-xs-2 -->

              <div class="col-md-4 col-sm-4 col-xs-4">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Available Units</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <!-- ./ x_title -->
                  <div class="x_content">
                    <div class="alert alert-danger"><span>No active units</span></div>
                      <?php getAvailableUnits();?>
                  </div>
                  <!-- ./ x_content -->
                </div>
                <!-- ./ x_panel -->
              </div>
              <!-- ./ col-md-4 col-sm-4 col-xs-4 -->

                <div class="col-md-4 col-sm-4 col-xs-4">
                    <div class="x_panel">
                    <div class="x_title">
                        <h2>Unavailable Units</h2>
                        <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <!-- ./ x_title -->
                    <div class="x_content">
                      <div class="alert alert-info"><span>No unavailable units</span></div>
                        <?php getUnAvailableUnits();?>
                    </div>
                    <!-- ./ x_content -->
                    </div>
                    <!-- ./ x_panel -->
                </div>
                <!-- ./ col-md-4 col-sm-4 col-xs-4 -->
            </div>
            <!-- ./ row -->        

          <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-4 col-sm-4 col-xs-4">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>NCIC Name Lookup</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <!-- ./ x_title -->
                  <div class="x_content">
                    <div class="input-group">
                      <input type="text" name="ncic_name" class="form-control" id="ncic_name" placeholder="John Doe" value="John Doe"/>
                        <span class="input-group-btn">
                          <button type="button" class="btn btn-primary" name="ncic_name_btn" id="ncic_name_btn">Send</button>
                        </span>
                    </div>
                    <!-- ./ input-group -->
                    <div name="ncic_name_return" id="ncic_name_return" contenteditable="false" style="background-color: #eee; opacity: 1; font-family: 'Courier New'; font-size: 15px; font-weight: bold;">
                      <!--<textarea class="form-control" style="resize:none;" id="ncic_name_return" name="ncic_name_return" readonly="readonly"></textarea> -->
                    </div>
                    <!-- ./ ncic_name_return -->
                  </div>
                  <!-- ./ x_content -->
                </div>
                <!-- ./ x_panel -->
              </div>
              <!-- ./ col-md-4 col-sm-4 col-xs-4 -->

              <div class="col-md-4 col-sm-4 col-xs-4">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>NCIC Plate Lookup</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <!-- ./ x_title -->
                  <div class="x_content">
                      <div class="input-group">
                      <input type="text" name="ncic_plate" class="form-control" id="ncic_plate" placeholder="License Plate, (ABC123)"/>
                        <span class="input-group-btn">
                          <button type="button" class="btn btn-primary" id="ncic_plate_btn">Send</button>
                        </span>
                    </div>
                    <!-- ./ input-group -->
                    <div name="ncic_plate_return" id="ncic_plate_return" contenteditable="false" style="background-color: #eee; opacity: 1; font-family: 'Courier New'; font-size: 15px; font-weight: bold;">
                    
                    </div>
                    <!-- ./ ncic_plate_return -->
                  </div>
                  <!-- ./ x_content -->
                </div>
                <!-- ./ x_panel -->
              </div>
              <!-- ./ col-md-4 col-sm-4 col-xs-4 -->

              <div class="col-md-4 col-sm-4 col-xs-4">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>NCIC Firearm Lookup</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <!-- ./ x_title -->
                  <div class="x_content">
                    <div class="input-group">
                      <input type="text" name="ncic_firearm" class="form-control" id="ncic_firearm" placeholder="Serial Number"/>
                        <span class="input-group-btn">
                          <button type="button" class="btn btn-primary" disabled>Send</button>
                        </span>
                    </div>
                    <!-- ./ input-group -->
                    <div name="firearm_return">
                      
                    </div>
                  </div>
                  <!-- ./ x_content -->
                </div>
                <!-- ./ x_panel -->
              </div>
              <!-- ./ col-md-4 col-sm-4 col-xs-4 -->
            </div>
            <!-- ./ row -->


          </div>
          <!-- "" -->
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
            <?php echo $community;?> CAD System
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <!-- modals -->
    <!-- Quick Guide Modal -->
    <div class="modal fade" id="quickGuide" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
            </button>
            <h4 class="modal-title" id="myModalLabel">CLI Quick Guide</h4>
          </div>
          <!-- ./ modal-header -->
          <div class="modal-body">
            <form>
                <div class="form-group row">
                <label class="col-lg-2 control-label">Create a new call</label>
                <div class="col-lg-10">
                  <input type="text" class="form-control" readonly="readonly" placeholder="action, callsign, calltype, 'location', 'notes'" />
                  <input type="text" class="form-control" readonly="readonly" placeholder="new, 5V-29, 10-11, 'Alta Street at Hawick Avenue', '4 door blue sedan occ 2x'" />
                </div>
                <!-- ./ col-sm-9 -->
              </div>
              <!-- ./ form-group -->
              <div class="form-group row">
                <label class="col-lg-2 control-label">Change Unit Status</label>
                <div class="col-lg-10">
                  <input type="text" class="form-control" readonly="readonly" placeholder="action, callsign, status" />
                  <input type="text" class="form-control" readonly="readonly" placeholder="status, 5V-29, 10-6" />
                </div>
                <!-- ./ col-sm-9 -->
              </div>
              <!-- ./ form-group -->
              <div class="form-group row">
                <label class="col-lg-2 control-label">Assign Unit to Call</label>
                <div class="col-lg-10">
                  <input type="text" class="form-control" readonly="readonly" placeholder="action, callId, callsign" />
                  <input type="text" class="form-control" readonly="readonly" placeholder="assign, 1234, 5V-29" />
                </div>
                <!-- ./ col-sm-9 -->
              </div>
              <!-- ./ form-group -->
              <div class="form-group row">
                <label class="col-lg-2 control-label">NCIC Lookup</label>
                <div class="col-lg-10">
                  <input type="text" class="form-control" readonly="readonly" placeholder="action, name/plate" />
                  <input type="text" class="form-control" readonly="readonly" placeholder="ncic, 'John Doe'" />
                  <input type="text" class="form-control" readonly="readonly" placeholder="ncic, 'ABC123'" />
                </div>
                <!-- ./ col-sm-9 -->
              </div>
              <!-- ./ form-group -->
            </form>
          </div>
          <!-- ./ modal-body -->
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
          <!-- ./ modal-footer -->
        </div>
        <!-- ./ modal-content -->
      </div>
      <!-- ./ modal-dialog modal-lg -->
    </div>
    <!-- ./ modal fade bs-example-modal-lg -->

    <!-- New Call Modal -->
    <div class="modal fade" id="newCall" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
            </button>
            <h4 class="modal-title" id="myModalLabel">New Call</h4>
          </div>
          <!-- ./ modal-header -->
          <div class="modal-body">
            <form method="post" action="../actions/dispatchActions.php" class="newCallForm">
                <div class="form-group row">
                <label class="col-lg-2 control-label">Incident Type</label>
                <div class="col-lg-10">
                  <select class="form-control selectpicker" data-live-search="true" name="call_type">
                    <option>Test</option>
                    <option>10-11</option>
                  </select>
                </div>
                <!-- ./ col-sm-9 -->
              </div>
              <!-- ./ form-group -->
              <div class="form-group row">
                <label class="col-lg-2 control-label">Address</label>
                <div class="col-lg-10">
                  <input type="text" class="form-control txt-auto" id="street1" name="street1" placeholder="Street 1" required/>
                  <input type="text" class="form-control txt-auto2" placeholder="Street 2/Cross/Postal" />
                </div>
                <!-- ./ col-sm-9 -->
              </div>
              <!-- ./ form-group -->
              <div class="form-group row">
                <label class="col-lg-2 control-label">Assign Unit to Call</label>
                <div class="col-lg-10">
                  <input type="checkbox" name="unassigned" class="flat">&nbsp;Unassigned
                  <input name="unit1" type="text" class="form-control" placeholder="Unit 1" />
                  <input type="text" class="form-control" placeholder="Unit 2" />
                </div>
                <!-- ./ col-sm-9 -->
              </div>
              <!-- ./ form-group -->
              <div class="form-group row">
                <label class="col-lg-2 control-label">Narrative</label>
                <div class="col-lg-10">
                  <textarea name="narrative" class="form-control" rows="5"></textarea>
                </div>
                <!-- ./ col-sm-9 -->
              </div>
              <!-- ./ form-group -->
            
          </div>
          <!-- ./ modal-body -->
          <div class="modal-footer">
            <input type="submit" name="create_call" class="btn btn-primary" value="Send"/>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
          <!-- ./ modal-footer -->
          </form>
        </div>
        <!-- ./ modal-content -->
      </div>
      <!-- ./ modal-dialog modal-lg -->
    </div>
    <!-- ./ modal fade bs-example-modal-lg -->



    <!-- jQuery -->
    <script src="../vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="../vendors/fastclick/lib/fastclick.js"></script>
    <!-- iCheck -->
    <script src="../vendors/iCheck/icheck.min.js"></script>
    <!-- NProgress -->
    <script src="../vendors/nprogress/nprogress.js"></script>
    <!-- Datatables -->
    <script src="../vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="../vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="../vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="../vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="../vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="../vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
    <!-- Bootstrap Select -->
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.1/js/bootstrap-select.min.js"></script>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.1/css/bootstrap-select.min.css">
    -<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    
    
    <script>
    $(document).ready(function() {
        $('#pendingUsers').DataTable({
            paging: false,
            searching: false
        });

        $(function() {
            $('#menu_toggle').click();
        });
    });
	  </script>


  
    <!-- TODO: FIX -->
    <script>
    $( ".txt-auto" ).autocomplete({
      source: "../actions/dispatchActions.php",
      minLength: 2
    });
    $( ".txt-auto" ).autocomplete( "option", "appendTo", ".newCallForm" );

    $( ".txt-auto2" ).autocomplete({
      source: "../actions/dispatchActions.php",
      minLength: 2
    });
    $( ".txt-auto2" ).autocomplete( "option", "appendTo", ".newCallForm" );


    $(".modal input:checkbox").on('change', function () {
        var self = $(this);
        if (self.is(":checked")) {
            
        } else {
            
        }
    });
    </script>
  
    <script>
    $('#ncic_name_btn').on('click', function(e) {

      var name = document.getElementById('ncic_name').value;
      $('#ncic_name_return').empty();

      $.ajax({
          cache: false,
          type: 'POST',
          url: '../actions/ncic.php',
          data: {'ncicName': 'yes',
                  'ncic_name' : name},

          success: function(result) 
          {
            console.log(result);
            data = JSON.parse(result);

            var textarea = document.getElementById("ncic_name_return");

            if (data['noResult'] == "true")
            {
              $('#ncic_name_return').append("<p style=\"color:red;\">NAME NOT FOUND");
            }
            else
            {
              if (data['noWarrants'] == "true")
              {
                var warrantText = "&nbsp;&nbsp;&nbsp;&nbsp;<span style=\"color: green\">NO WARRANTS</span><br/>";
              }
              else
              {
                var warrantText = "";
                warrantText += "    Count: "+data.warrant_name.length+"<br/>";
                for (i=0; i<data.warrant_name.length; i++)
                {
                  warrantText += "<span style=\"color:red\">&nbsp;&nbsp;&nbsp;&nbsp;"+data.warrant_name[i] + "</span><br/>";  
                }
              }

              if (data['noWarrants'] == "true")
              {
                var citationText = "&nbsp;&nbsp;&nbsp;&nbsp;<span style=\"color: green\">NO CITATIONS</span>";
              }
              else
              {
                var citationText = "";
                citationText += "    Count: "+data.citation_name.length+"<br/>";
                for (i=0; i<data.citation_name.length; i++)
                {
                  citationText += "&nbsp;&nbsp;&nbsp;&nbsp;"+data.citation_name[i]+"<br/>";  
                }
              }

              var dl_status_text = ""
              if (data['dl_status'] == "Valid")
              {
                 dl_status_text = "<span style=\"color: green;\">Valid</span>";
              }
              else
              {
                dl_status_text = "<span style=\"color: red;\">"+data['dl_status']+"</span>";
              }

              $('#ncic_name_return').append("Name: "+data['first_name']+" "+data['last_name']+"<br/>DOB: "+data['dob']+"<br/>Age: "+data['age']+"<br/>Sex: "+data['sex']+"<br/>Address: "+data['address']+"<br/>Race: "+data['race']+"<br/>DL Status: "+dl_status_text+
              "<br/>Hair Color: "+data['hair_color']+"<br/>Build: "+data['build']+"<br/><br/>Warrants: <br/>"+warrantText+"<br/>Citations:<br/>"+citationText);

              $("#ncic_name_return").attr("tabindex",-1).focus();
            }
          },

          error:function(exception){alert('Exeption:'+exception);}
        });
    });
    </script>

    <script>
    $('#ncic_plate_btn').on('click', function(e) {

      var plate = document.getElementById('ncic_plate').value;
      $('#ncic_plate_return').empty();

      $.ajax({
          cache: false,
          type: 'POST',
          url: '../actions/ncic.php',
          data: {'ncicPlate': 'yes',
                  'ncic_plate' : plate},

          success: function(result) 
          {
            console.log(result);
            data = JSON.parse(result);

            if (data['noResult'] == "true")
            {
              $('#ncic_plate_return').append("<p style=\"color:red;\">PLATE NOT FOUND");
            }
            else
            {
              var insurance_status = ""
              if (data['veh_insurance'] == "VALID")
              {
                 insurance_status = "<span style=\"color: green;\">Valid</span>";
              }
              else
              {
                insurance_status = "<span style=\"color: red;\">"+data['veh_insurance']+"</span>";
              }

              var notes = ""
              if (data['notes'] == "")
              {
                 notes = "NO VEHICLE NOTES";
              }
              else
              {
                notes = "<span style=\"font-weight: bold;\">"+data['notes']+"</span>";
              }

              $('#ncic_plate_return').append("Plate: "+data['plate']+"<br/>Color: "+data['veh_color']+"<br/>Make: "+data['veh_make']+"<br/>Model: "+data['veh_model']+"<br/>Owner: "+data['veh_ro']
              +"<br/>Insurance: "+insurance_status+"<br/><br/>Notes: "+notes);

              $("#ncic_plate_return").attr("tabindex",-1).focus();
            }
          },

          error:function(exception){alert('Exeption:'+exception);}
        });
    });
    </script>

    <script>
    function toggleFullScreen() {
        if ((document.fullScreenElement && document.fullScreenElement !== null) ||    
        (!document.mozFullScreen && !document.webkitIsFullScreen)) {
            if (document.documentElement.requestFullScreen) {  
            document.documentElement.requestFullScreen();  
            } else if (document.documentElement.mozRequestFullScreen) {  
            document.documentElement.mozRequestFullScreen();  
            } else if (document.documentElement.webkitRequestFullScreen) {  
            document.documentElement.webkitRequestFullScreen(Element.ALLOW_KEYBOARD_INPUT);  
            }  
        } else {  
            if (document.cancelFullScreen) {  
            document.cancelFullScreen();  
            } else if (document.mozCancelFullScreen) {  
            document.mozCancelFullScreen();  
            } else if (document.webkitCancelFullScreen) {  
            document.webkitCancelFullScreen();  
            }  
        }  
    }
    </script>

    <script>
    $("#ncic_name").keyup(function(event){
        if(event.keyCode == 13){
            $("#ncic_name_btn").click();
        }
    });
    </script>

    <script>
    $("#ncic_plate").keyup(function(event){
        if(event.keyCode == 13){
            $("#ncic_plate_btn").click();
        }
    });
    </script>

    <!-- Custom Theme Scripts -->
    <script src="../js/custom.js"></script>
  </body>
</html>
