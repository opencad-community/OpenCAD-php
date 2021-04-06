<?php
/**
 * @package Radio_Code_Reference
 * @version 1.0
 */
/*
Plugin Name: Radio Code Reference
Plugin URI: h
Description: Radio code reference overlay for OpenCAD Mobile Data Terminal.
Author: Phill Fernandes
Version: 1.0
Author URI:
*/

include_once( "../../../oc-config.php");
include_once( ABSPATH . "/oc-settings.php");
include( ABSPATH .`/`. OCINC . "/publicFunctions.php");

?>

<head>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="https://bootswatch.com/4/darkly/bootstrap.min.css">
</head>

<div id="core-refConent">
<nav class="nav nav-tabs nav-justified">
  <a rel="noopener" class="nav-item nav-link active" data-toggle="tab" href="#home">Statuses</a>
  <a rel="noopener" class="nav-item nav-link" data-toggle="tab" href="#menu1">Incidents</a>
  <a rel="noopener" class="nav-item nav-link" data-toggle="tab" href="#menu2">Citations</a>
</nav>
    <div class="tab-content">
  <div id="home" class="tab-pane fade show active" style="padding-left:10px;padding-right:10px;">
    <h3>Status Codes</h3>
    <table class="table table-dark tbl_codeReference">
      <caption>Radio code reference.</caption>
      <thead>
        <tr>
          <th scope="col">Code</th>
          <th scope="col">Status</th>
        </tr>
      </thead>
      <tbody>
        <?php getData2($table = "statuses", $column1 = "1", $column2 = "2"); ?>
      </tbody>
    </table>
  </div>
  <div id="menu1" class="tab-pane fade" style="padding-left:10px;padding-right:10px;">
    <h3>Incidents</h3>
        <table class="table table-dark tbl_codeReference">
          <thead>
              <tr>
                  <th scope="col">Code</th>
                  <th scope="col">Incident</th>
              </tr>
          </thead>
          <tbody>
              <?php getData2($table = "incidentTypes", $column1 = "2", $column2 = "1"); ?>
          </tbody>
        </table>
    </div>
    <div id="menu2" class="tab-pane fade" style="padding-left:10px;padding-right:10px;">
    <h3>Penal Code</h3>
        <table class="table table-dark tbl_codeReference">
          <thead>
            <tr>
              <th scope="col">Penal Code ID</th>
              <th scope="col">Citation Amount</th>
              <th scope="col">Citation Description</th>
            </tr>
          </thead>
          <tbody>
            <?php getData3($table = "citationTypes", $column1 = "1", $column2 = "2", $column3 = "3"); ?>
          </tbody>
        </table>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/autofill/2.3.3/js/dataTables.autoFill.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/autofill/2.3.3/js/autoFill.bootstrap4.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.bootstrap4.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.colVis.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/colreorder/1.5.0/js/dataTables.colReorder.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/fixedcolumns/3.2.5/js/dataTables.fixedColumns.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/fixedheader/3.1.4/js/dataTables.fixedHeader.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/keytable/2.5.0/js/dataTables.keyTable.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.2/js/dataTables.responsive.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.2/js/responsive.bootstrap4.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/rowgroup/1.1.0/js/dataTables.rowGroup.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/rowreorder/1.2.4/js/dataTables.rowReorder.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/scroller/2.0.0/js/dataTables.scroller.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/select/1.3.0/js/dataTables.select.min.js"></script>


    <script> 

          $(document).ready(function () {
            $(".tbl_codeReference").DataTable({
                scrollY: "240px",
                "pageLength": 5,
            });
        });

    </script>


</body>

</html>