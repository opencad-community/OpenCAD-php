<?php
    
    $iniContents = parse_ini_file("./properties/config.ini", true); //Gather from config.ini file
    $community = $iniContents['strings']['community'];

?>

<html>
<head>
    <!-- CSS -->
    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="./css/bootstrap.css">
    <link rel="stylesheet" href="./css/bootstrap-multiselect.css"> <!-- CSS for MultiSelect Plugin -->

    <!-- JS -->
    <script type="text/javascript" src="./js/bootstrap-multiselect.js"></script> <!-- Script for MultiSelect Plugin -->

    <title><?php echo $community;?> CAD System</title>
    <link rel="icon" href="./images/favicon.ico" />
</head>
<body>
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header" style="text-align:center;"><?php echo $community;?> CAD System</h1>
                </div>
                <!-- ./ col-lg-12 -->
            </div>
            <!-- ./ row -->
            <div class="row">
                <div class="col-lg-6 col-lg-offset-3">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title" style="text-align:center;">Please Login to Use This System</h3>
                        </div>
                        <!-- ./ panel-heading -->
                        <div class="panel-body">
                            <form role="form" action="./actions/login.php" method="post">
                                <fieldset>
                                    <div class="form-group">
                                        <input class="form-control" placeholder="Email" name="email" type="text">
                                    </div>
                                    <!-- ./ form-group -->
                                    <div class="form-group">
                                        <input class="form-control" placeholder="Password" name="password" type="password" value="">
                                    </div>
                                    <!-- ./ form-group -->
                                    <input type="hidden" name="form_token" value="<?php echo $form_token; ?>" />
								    <input name="login_btn" type="submit" class="btn btn-lg btn-primary btn-block" value="Login" />
                                </fieldset>
                            </form>
                        </div>
                        <!-- ./ panel-body -->
                    </div>
                    <!-- ./ panel panel-primary -->
                </div>
                <!-- ./ col-lg-6 col-lg-offset-3 -->
            </div>
            <!-- ./ row -->
            <br/><br/>
            <div class="row">
                <div class="col-lg-6 col-lg-offset-3">
                    <div class="panel panel-danger">
                        <div class="panel-heading">
                            <h3 class="panel-title" style="text-align:center;">Not Registered? Request Access</h3>
                        </div>
                        <!-- ./ panel-heading -->
                        <div class="panel-body">
                            <form role="form" action="./actions/login.php" method="post">
                                <fieldset>
                                    <div class="form-group">
                                        <input class="form-control" placeholder="Name" name="name" type="text">
                                    </div>
                                    <!-- ./ form-group -->
                                    <div class="form-group">
                                        <input class="form-control" placeholder="Email" name="email" type="text">
                                    </div>
                                    <!-- ./ form-group -->
                                    <div class="form-group">
                                        <input class="form-control" placeholder="Identifier (Code Number, Unit ID)" name="Indentifier" type="text">
                                    </div>
                                    <!-- ./ form-group -->
                                    <div class="form-group">
                                        <label>Division (Can choose more than one)</label>
                                        <select class="form-control" id="division" multiple="multiple">
                                            <option value="communications">Communications (Dispatch)</option>
                                            <option value="ems">EMS</option>
                                            <option value="fire">Fire</option>
                                            <option value="highway">Highway Patrol</option>
                                            <option value="police">Police</option>
                                            <option value="sheriff">Sheriff</option>
                                        </select>
                                    </div>
                                    <!-- ./ form-group -->
                                    <div class="form-group">
                                        <input class="form-control" placeholder="Password" name="password" type="password" value="">
                                    </div>
                                    <!-- ./ form-group -->
                                    <div class="form-group">
                                        <input class="form-control" placeholder="Confirm Password" name="password2" type="password" value="">
                                    </div>
                                    <!-- ./ form-group -->

                                    <input type="hidden" name="form_token" value="<?php echo $form_token; ?>" />
								    <input name="login_btn" type="submit" class="btn btn-lg btn-primary btn-block" value="Request Access" />
                                </fieldset>
                            </form>
                        </div>
                        <!-- ./ panel-body -->
                    </div>
                    <!-- ./ panel panel-primary -->
                </div>
                <!-- ./ col-lg-6 col-lg-offset-3 -->
            </div>
            <!-- ./ row -->

        </div>
        <!-- ./ container-fluid -->
    </div>
    <!-- ./ page-wrapper -->

    <!-- Plugin Intializations -->
    <!-- Initialize the plugin: -->
    <script type="text/javascript">
    $(document).ready(function() {
        $('#division').multiselect();
    });
    </script>
</body>
</html>