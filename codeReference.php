<?php
        include_once(__DIR__ . "./oc-config.php");
        include(__DIR__ . "./actions/publicFunctions.php");
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>10-Codes</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>

<body>
    <div>
        <ul class="nav nav-tabs">
            <li><a href="#tab-2" role="tab" data-toggle="tab">Incident </a></li>
            <li class="active"><a href="#tab-1" role="tab" data-toggle="tab">Status </a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane" role="tabpanel" id="tab-5">
                <p>Tab content.</p>
            </div>
            <div class="tab-pane active" role="tabpanel" id="tab-1">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="info">Code </th>
                                <th class="info">Purpose </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php getData($tableName = "statuses", $column1 = "2", $column1 = "1"); ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane" role="tabpanel" id="tab-4">
                <p>Tab content.</p>
            </div>
            <div class="tab-pane" role="tabpanel" id="tab-2">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="info">Code </th>
                                <th class="info">Purpose </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php getData($tableName = "incident_types", $column1 = "1", $column1 = "2"); ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane" role="tabpanel" id="tab-3">
                <p>Third tab content.</p>
            </div>
        </div>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>