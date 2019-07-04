<?php
        include_once(__DIR__ . "./oc-config.php");
        include(__DIR__ . "./actions/publicFunctions.php");

?>


    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://bootswatch.com/4/darkly/bootstrap.min.css">
<div id="core-refConent">
<nav class="nav nav-tabs nav-justified">
  <a class="nav-item nav-link active" data-toggle="tab" href="#home">Statuses</a>
  <a class="nav-item nav-link" data-toggle="tab" href="#menu1">Incidents</a>
</nav>

<div class="tab-content" style="padding-left:10px;padding-right:10px;">
  <div id="home" class="tab-pane fade show active">
    <h3>Status Codes</h3>
    <table class="table table-dark" id="tbl_codeReference_status">
  <thead>
    <tr>
      <th scope="col">Code</th>
      <th scope="col">Status</th>
    </tr>
  </thead>
  <tbody>
    <?php getData($table = "statuses", $column1 = "0", $column12 = "1"); ?>
  </tbody>
</table>
  </div>
  <div id="menu1" class="tab-pane fade">
    <h3>Incidents</h3>
        <table class="table table-dark" id="tbl_codeReference_incident">
        <thead>
            <tr>
                <th scope="col">Code</th>
                <th scope="col">Incident</th>
            </tr>
        </thead>
        <tbody>
            <?php getData($table = "incident_types", $column1 = "2", $column12 = "1"); ?>
        </tbody>
        </table>
    </div>
</div>
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
            $("#tbl_codeReference_status").DataTable({
                scrollY: "240px",
                "pageLength": 5,
                "responsive": true,
                paging:true
            });
        });

        $(document).ready(function () {
            $("#tbl_codeReference_incident").DataTable({
                scrollY: "240px",
                "pageLength": 5,
                "responsive": true,
                paging:true
            });
        });
    </script>


</body>

</html>