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

    <title><?php echo $community;?> Responder</title>
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
    <link href="https://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" rel="Stylesheet"></link>
    <!-- PNotify -->
    <link href="../vendors/pnotify/dist/pnotify.css" rel="stylesheet">
    <link href="../vendors/pnotify/dist/pnotify.buttons.css" rel="stylesheet">
    <link href="../vendors/pnotify/dist/pnotify.nonblock.css" rel="stylesheet">
    

    <!-- Custom Theme Style -->
    <link href="../css/custom.css" rel="stylesheet">
  </head>
  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="javascript:void(0)" class="site_title"><i class="fa fa-tachometer"></i> <span>Responder</span></a>
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
                  <li class="active"><a><i class="fa fa-external-link"></i> Links <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="https://goo.gl/forms/rEJOoJvIlCM5svSo1" target="_blank">Police PAL</a></li>
                      <li><a href="https://docs.google.com/forms/d/e/1FAIpQLSdDd1zZGTqUUuGQYuHzmz3TAIWb49y3BDFr8GwRbisLnwiRGg/viewform" target="_blank">Highway PAL</a></li>
                      <li><a href="https://docs.google.com/forms/d/e/1FAIpQLSd26EN4XdgKhbZBEJ16B8cx5LqTNxguh4O3wNggRqqzKOmXzg/viewform" target="_blank">Sheriff PAL</a></li>
                      <li><a href="https://docs.google.com/forms/d/e/1FAIpQLScXgKDn0deB7zgnmBvDRJ7KllHLiQdmahvgQbphxZuNhU6h2g/viewform" target="_blank">Fire PAL</a></li>
                    </ul>
                  </li>
                  <li class="active"><a><i class="fa fa-hashtag"></i> Callsign <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a id="changeCallsign" class="btn-link" name="changeCallsign" data-toggle="modal" data-target="#callsign">Change Callsign</a></li>
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
                <h3>CAD Responder</h3>
              </div>
              <!-- ./ title_left -->
            </div>
            <!-- ./ page-title -->

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
                      <div id="live_calls">

                      </div>
                  </div>
                  <!-- ./ x_content -->
                </div>
                <!-- ./ x_panel -->
              </div>
              <!-- ./ col-md-12 col-sm-12 col-xs-12 -->
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
    <!-- Callsign Modal -->
    <div class="modal fade" id="callsign" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-md">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
            </button>
            <h4 class="modal-title" id="myModalLabel">Enter Your Callsign for This Patrol</h4>
          </div>
          <!-- ./ modal-header -->
          <div class="modal-body">
            <form>
            <div class="form-group">
              <label class="col-md-2 control-label">Callsign</label>
              <div class="col-md-10">
                <input type="text" id="callign" name="callsign" class="form-control" />
              </div>
              <!-- ./ col-sm-9 -->
            </div>
            <!-- ./ form-group -->
          </div>
          <!-- ./ modal-body -->
          <div class="modal-footer">
            <input type="submit" name="setCallsign" class="btn btn-primary" value="Set Callsign"/>
          </div>
          <!-- ./ modal-footer -->
          </form>
        </div>
        <!-- ./ modal-content -->
      </div>
      <!-- ./ modal-dialog modal-md -->
    </div>
    <!-- ./ modal fade -->

    <!-- Call Details Modal -->
    <div class="modal fade" id="callDetails" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" id="closecallDetails"><span aria-hidden="true">×</span>
            </button>
            <h4 class="modal-title" id="myModalLabel">Call Details</h4>
          </div>
          <!-- ./ modal-header -->
          <div class="modal-body">
          <form class="callDetailsForm">
            <div class="form-group">
              <label class="col-lg-2 control-label">Incident ID</label>
              <div class="col-lg-10">
                <input type="text" id="call_id_det" name="call_id_det" class="form-control" disabled>
              </div>
              <!-- ./ col-sm-9 -->
            </div>
            <br/>
            <!-- ./ form-group -->
            <div class="form-group">
              <label class="col-lg-2 control-label">Incident Type</label>
              <div class="col-lg-10">
                <input type="text" id="call_type_det" name="call_type_det" class="form-control" disabled>
              </div>
              <!-- ./ col-sm-9 -->
            </div>
            <br/>
            <!-- ./ form-group -->
            <div class="form-group">
              <label class="col-lg-2 control-label">Street 1</label>
              <div class="col-lg-10">
                <input type="text" id="call_street1_det" name="call_street1_det" class="form-control" disabled>
              </div>
              <!-- ./ col-sm-9 -->
            </div>
            <br/>
            <!-- ./ form-group -->
            <div class="form-group">
              <label class="col-lg-2 control-label">Street 2</label>
              <div class="col-lg-10">
                <input type="text" id="call_street2_det" name="call_street2_det" class="form-control" disabled>
              </div>
              <!-- ./ col-sm-9 -->
            </div>
            <br/>
            <!-- ./ form-group -->
            <div class="form-group">
              <label class="col-lg-2 control-label">Street 3</label>
              <div class="col-lg-10">
                <input type="text" id="call_street3_det" name="call_street3_det" class="form-control" disabled>
              </div>
              <!-- ./ col-sm-9 -->
            </div>
            
            <div class="clearfix">
            <br/><br/><br/><br/>
            <!-- ./ form-group -->
            <div class="form-group">
              <label class="col-lg-2 control-label">Narrative</label>
              <div class="col-lg-10">
                <div name="call_narrative" id="call_narrative" contenteditable="false" style="background-color: #eee; opacity: 1; border: 1px solid #ccc; padding: 6px 12px; font-size: 14px;"></div>
              </div>
              <!-- ./ col-sm-9 -->
            </div>
            <br/>
            <!-- ./ form-group -->
          </div>
          <!-- ./ modal-body -->
          </form>
          <br/>
          <div class="modal-footer">
            <button id="closeDetailsModal" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
          <!-- ./ modal-footer -->
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    
    <!-- PNotify -->
    <script src="../vendors/pnotify/dist/pnotify.js"></script>
    <script src="../vendors/pnotify/dist/pnotify.buttons.js"></script>
    <script src="../vendors/pnotify/dist/pnotify.nonblock.js"></script>

    <script>
    $(document).ready(function() {
        $(function() {
            $('#menu_toggle').click();
        });

        $('#callsign').modal('show');

        getCalls();

    });
	</script>

    <script>
    function getCalls() {
        $.ajax({
              type: "GET",
              url: "../actions/api.php",
              data: {
                  getCalls: 'yes',
                  responder: 'yes'
              },
              success: function(response) 
              {
                $('#live_calls').html(response);
                setTimeout(getCalls, 5000);
                
              },
              error : function(XMLHttpRequest, textStatus, errorThrown)
              {
                console.log("Error");
              }
              
            }); 
      }
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
    $('#callDetails').on('shown.bs.modal', function(e) {
      var $modal = $(this), callId = e.relatedTarget.id;

      $.ajax({
          cache: false,
          type: 'GET',
          url: '../actions/api.php',
          data: {'getCallDetails': 'yes',
                  'callId' : callId},
          success: function(result) 
          {
            data = JSON.parse(result);
            console.log(data);

            var mymodal = $('#callDetails');
            mymodal.find('input[name="call_id_det"]').val(data['call_id']);
            mymodal.find('input[name="call_type_det"]').val(data['call_type']);
            mymodal.find('input[name="call_street1_det"]').val(data['call_street1']);
            mymodal.find('input[name="call_street2_det"]').val(data['call_street2']);
            mymodal.find('input[name="call_street3_det"]').val(data['call_street3']);
            mymodal.find('div[name="call_narrative"]').html('');
            mymodal.find('div[name="call_narrative"]').append(data['narrative']);

          },

          error:function(exception){alert('Exeption:'+exception);}
        });
    });
    </script>

    <script>
    $('#callsign').on('shown.bs.modal', function(e) {
        $('#callsign').find('input[name="callsign"]').val('<?php echo $_SESSION['identifier'];?>');
    });
    </script>

    
    

    <!-- Custom Theme Scripts -->
    <script src="../js/custom.js"></script>

  </body>
</html>
