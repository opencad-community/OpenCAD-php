<?php
require("./oc-config.php");
session_start();

if (empty($_SESSION['logged_in']))
{
	header('Location: ./index.php');
    die("Not logged in");
}


/*
    The purpose of this page is to simply determine if the user has multiple roles.
    If they do, provide them the option to go where they want to go.
    Else, redirect to the only place they can go.
*/

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

if (!$link) {
    die('Could not connect: ' .mysql_error());
}

$id = $_SESSION['id'];
$sql = "SELECT * from user_departments WHERE user_id = \"$id\"";

$result=mysqli_query($link, $sql);

$adminButton = "";
$dispatchButton = "";
$highwayButton = "";
$fireButton = "";
$emsButton = "";
$sheriffButton = "";
$policeButton = "";
$civilianButton = "";

$num_rows = $result->num_rows;
// This loop will auto redirect the user if they only have one option
// TODO: Add the rest of the headers
if($num_rows < 2)
{
    while($row = mysqli_fetch_array($result, MYSQLI_BOTH))
    {
        if ($row[1] == "0")
        {
            $_SESSION['admin'] = 'YES';
            header("Location:./oc-admin/admin.php");

        }
        else if ($row[1] == "1")
        {
            $_SESSION['dispatch'] = 'YES';
            header("Location:./cad.php");

        }
        else if ($row[1] == "2")
        {
            $_SESSION['ems'] = 'YES';
            header("Location:./mdt.php");
        }
            else if ($row[1] == "3")
        {
            $_SESSION['fire'] = 'YES';
            header("Location:./mdt.php");
        }
        else if ($row[1] == "4")
        {
            $_SESSION['highway'] = 'YES';
            header("Location:./mdt.php");
        }
        else if ($row[1] == "5")
        {
            $_SESSION['police'] = 'YES';
            header("Location:./mdt.php");
        }
        else if ($row[1] == "6")
        {
            $_SESSION['sheriff'] = 'YES';
            header("Location:./mdt.php");
        }
        else if ($row[1] == "7")
        {
            $_SESSION['civilian'] = 'YES';
            header("Location:./civillian.php");
        }

    }
}
else
{

    while($row = mysqli_fetch_array($result, MYSQLI_BOTH))
    {
        if ($row[1] == 0)
        {
            $adminButton = "<a href=\"./oc-admin/admin.php\" class=\"btn btn-primary btn-lg\">Administration</a>";
            $_SESSION['admin'] = 'YES';
        }
        if ($row[1] == 1)
        {
            $_SESSION['dispatch'] = 'YES';
            $dispatchButton = "<a href=\"./cad.php\" class=\"btn btn-primary btn-lg\">Dispatch</a>";
        }
        if ($row[1] == "2")
        {
            $_SESSION['ems'] = 'YES';
            $emsButton = "<a href=\"./mdt.php\" class=\"btn btn-primary btn-lg\">EMS</a>";
        }
        if ($row[1] == "3")
        {
            $_SESSION['fire'] = 'YES';
            $fireButton = "<a href=\"./mdt.php?fire=true\" class=\"btn btn-primary btn-lg\">Fire Department</a>";
        }
        if ($row[1] == "4")
        {
            $_SESSION['highway'] = 'YES';
            $highwayButton = "<a href=\"./mdt.php\" class=\"btn btn-primary btn-lg\">Highway Patrol</a>";
        }
        if ($row[1] == "5")
        {
            $_SESSION['police'] = 'YES';
            $policeButton = "<a href=\"./mdt.php\" class=\"btn btn-primary btn-lg\">Police Department</a>";
        }
        if ($row[1] == "6")
        {
            $_SESSION['sheriff'] = 'YES';
            $sheriffButton = "<a href=\"./mdt.php\" class=\"btn btn-primary btn-lg\">Sheriff's Office</a>";
        }
        if ($row[1] == "7")
        {
            $_SESSION['civillian'] = 'YES';
            $civilianButton = "<a href=\"./civilian.php\" class=\"btn btn-primary btn-lg\">Civilian</a>";
        }
    }
}
mysqli_close($link);

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>Starter Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    <!-- Font Awesome -->
    <link href="./vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="./css/365dashboard.css" rel="stylesheet">
  </head>

  <body>

    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
      <a class="navbar-brand" href="#">Navbar</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
      <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Link</a>
          </li>
          <li class="nav-item">
            <a class="nav-link disabled" href="#">Disabled</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown</a>
            <div class="dropdown-menu" aria-labelledby="dropdown01">
              <a class="dropdown-item" href="#">Action</a>
              <a class="dropdown-item" href="#">Another action</a>
              <a class="dropdown-item" href="#">Something else here</a>
            </div>
          </li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <li class="nav-item dropdown">
            <a href="javascript:;" class="nav-link" data-toggle="dropdown" aria-expanded="false">
              <img src="./images/user.png" alt="" height="29px" width="29px" style="padding:2px;"><?php echo $_SESSION['name']; ?>
            </a>
            <ul class="dropdown-menu dropdown-usermenu pull-right">
              <li><a href="https://github.com/ossified/openCad/issues" class="dropdown-item">Help</a></li>
              <li>
                <a class="dropdown-item" data-toggle="tooltip" data-placement="top" title="Logout" href="./actions/logout.php">Log Out</a>
                <span class="glyphicon glyphicon-log-out" aria-hidden="true" style="color:black"></span>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>

    <div class="container">

      <div class="starter-template">
        <h1>Bootstrap starter template</h1>
        <p class="lead">Use this document as a way to quickly start any new project.<br> All you get is this text and a mostly barebones HTML document.</p>
      </div>

    </div><!-- /.container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
  </body>
</html>
