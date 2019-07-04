<?php
if(basename($_SERVER['PHP_SELF']) == 'admin.php') {
  $pageName = "OpenCAD Admin Dashboard";
  $currentPage = 'class="acitve"';
} else  if(basename($_SERVER['PHP_SELF']) == 'callhistory.php') {
  $pageName = "Call History";
  $currentPage = 'class="acitve"';
} else  if(basename($_SERVER['PHP_SELF']) == 'ncicAdmin.php') {
  $pageName = "Civillian Profile Manager (CPM)";
  $currentPage = 'class="acitve"';
} else  if(basename($_SERVER['PHP_SELF']) == 'permissionManagmeent.php') {
  $pageName = "Permissions Management";
  $currentPage = 'class="acitve"';
} else  if(basename($_SERVER['PHP_SELF']) == 'userManagement.php') {
  $pageName = "User Management";
  $currentPage = 'class="acitve"';
} else  if(basename($_SERVER['PHP_SELF']) == 'cad.php') {
  $pageName = "Computer Aided Dispatch (CAD)";
  $currentPage = 'class="acitve"';
} else  if(basename($_SERVER['PHP_SELF']) == 'mdt.php') {
  $pageName = "Mobile Data Terminal (MDT)";
  $currentPage = 'class="acitve"';
} else  if(basename($_SERVER['PHP_SELF']) == 'civilian.php') {
  $pageName = "Civillian Console";
  $currentPage = 'class="acitve"';
} else  if(basename($_SERVER['PHP_SELF']) == 'dashboard.php') {
  $pageName = "OpenCAD Dashboard";
  $currentPage = 'class="acitve"';
} else  if(basename($_SERVER['PHP_SELF']) == 'about.php') {
  $pageName = "About OpenCad";
  $currentPage = 'class="acitve"';
} else {
  $pageName = "OpenCAD";
}

?>

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <base href="<?php echo BASE_URL; ?>">
  <title><?php echo $pageName." | ".COMMUNITY_NAME;?></title>
  <link rel="icon" href="<?php echo BASE_URL; ?>/images/favicon.ico" />

  <!-- Bootstrap -->
  <link href="<?php echo BASE_URL; ?>/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
  <!--<link href="<?php echo BASE_URL; ?>/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">-->
  <!-- NProgress -->
  <link href="<?php echo BASE_URL; ?>/vendors/nprogress/nprogress.css" rel="stylesheet">
  <!-- Animate.css -->
  <link href="<?php echo BASE_URL; ?>/vendors/animate.css/animate.min.css" rel="stylesheet">
  <!-- Datatables -->
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.18/af-2.3.3/b-1.5.6/b-colvis-1.5.6/b-html5-1.5.6/b-print-1.5.6/cr-1.5.0/fc-3.2.5/fh-3.1.4/kt-2.5.0/r-2.2.2/rg-1.1.0/rr-1.2.4/sc-2.0.0/sl-1.3.0/datatables.min.css"/>
 
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>

  <!-- Custom Theme Style -->
  <link href="<?php echo BASE_URL; ?>/css/custom.css" rel="stylesheet">
  
  <!-- jsPanel CSS -->
  <link href="https://cdn.jsdelivr.net/npm/jspanel4@4.6.0/dist/jspanel.css" rel="stylesheet">

  <style>
  #buttonGroup {
    margin: 50%px 50%px;
    position:relative;
    text-align:center;
  }
  .cusbtn {
      color: grey;
      border: 3px solid grey;
      padding: 16px 32px;
      text-align: center;
      display: inline-block;
      font-size: 16px;
      margin: 4px 2px;
      -webkit-transition-duration: 0.4s; /* Safari */
      transition-duration: 0.4s;
      cursor: pointer;
      text-decoration: none;
      text-transform: uppercase;

  }
  .animate {
  -webkit-animation-duration: 1s;
  animation-duration: 1s;
  -webkit-animation-fill-mode: both;
  animation-fill-mode: both;
}
.delay1 {
-webkit-animation-delay: 2s;
-moz-animation-delay: 2s;
animation-delay: 2s;
}
.delay2 {
-webkit-animation-delay: 0.5s;
-moz-animation-delay: 0.5s;
animation-delay: 0.5s;
}
@keyframes fadeInLeft {
  from {
    opacity: 0;
    -webkit-transform: translate3d(-100%, 0, 0);
    transform: translate3d(-100%, 0, 0);
  }

  to {
    opacity: 1;
    -webkit-transform: none;
    transform: none;
  }
}

.fadeInLeft {
  -webkit-animation-name: fadeInLeft;
  animation-name: fadeInLeft;
}

        .night{
            background: #e6e6e6;
        }
        .day{
            background: white;
        }
  </style>
  <script>
        function day(){
            body.className='day';
        }
        function night(){
            body.className='night';
        }
    </script>
</head>
