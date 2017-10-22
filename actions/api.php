<?php
/**
Open source CAD system for RolePlaying Communities.
Copyright (C) 2017 Shane Gill

This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

This program comes with ABSOLUTELY NO WARRANTY; Use at your own risk.
**/
/*
    This file handles all actions for admin.php script
*/

require_once(__DIR__ . "/../oc-config.php");

if (isset($_GET['a'])){
    getActiveCalls();
}
if (isset($_GET['getCalls'])){
    getActiveCalls();
}
if (isset($_GET['getCallDetails'])){
    getCallDetails();
}
if (isset($_GET['getAvailableUnits'])){
    getAvailableUnits();
}
if (isset($_GET['getUnAvailableUnits'])){
    getUnAvailableUnits();
}
if (isset($_POST['changeStatus'])){
    changeStatus();
}
if (isset($_GET['getActiveUnits']))
{
    getActiveUnits();
}
if (isset($_GET['getActiveUnitsModal']))
{
    getActiveUnitsModal();
}
if (isset($_POST['logoutUser']))
{
    logoutUser();
}
if (isset($_POST['setTone']))
{
    setTone();
}
if (isset($_GET['checkTones']))
{
    checkTones();
}
if (isset($_GET['getDispatchers']))
{
    getDispatchers();
}
if (isset($_POST['quickStatus']))
{
    quickStatus();
}

function quickStatus()
{
    $event = $_POST['event'];
    $callId = $_POST['callId'];
    session_start();
    $callsign = $_SESSION['callsign'];


    //var_dump($_SESSION);

    switch($event)
    {
        case "enroute":
            $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

            if (!$link) {
                die('Could not connect: ' .mysql_error());
            }

            //Update the call_notes to say they're en-route
            $narrativeAdd = date("Y-m-d H:i:s").': '.$callsign.': En-Route<br/>';


            $sql = "UPDATE calls SET call_notes = concat(call_notes, ?) WHERE call_id = ?";

            try {
                $stmt = mysqli_prepare($link, $sql);
                mysqli_stmt_bind_param($stmt, "si", $narrativeAdd, $callId);
                $result = mysqli_stmt_execute($stmt);

                if ($result == FALSE) {
                    die(mysqli_error($link));
                }
            }
            catch (Exception $e)
            {
                die("Failed to run query: " . $e->getMessage()); //TODO: A function to send me an email when this occurs should be made
            }

            break;

        case "onscene":

            break;
    }

}

function getMyCall()
{
    //First, check to see if they're on a call
    $identifier = $_SESSION['identifier'];

    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    if (!$link) {
        die('Could not connect: ' .mysql_error());
    }

    $sql = "SELECT * from active_users WHERE identifier = '$identifier' AND status = '0' AND status_detail = '3'";

    $result = mysqli_query($link, $sql);

    $num_rows = $result->num_rows;

    echo '
        <div class="col-md-6 col-sm-6 col-xs-6">
            <div class="x_panel">
                <div class="x_title">
                <h2>My Call</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                </ul>
                <div class="clearfix"></div>
                </div>
                <!-- ./ x_title -->
                <div class="x_content">
    ';


    if($num_rows == 0)
    {
        echo '<div class="alert alert-info"><span>Not currently on a call</span></div>';
    }
    else
    {
        //Figure out what call the user is on
        $sql = "SELECT call_id from calls_users WHERE identifier = '$identifier'";

        $result = mysqli_query($link, $sql);

        while($row = mysqli_fetch_array($result, MYSQLI_BOTH))
        {
            $call_id = $row[0];
        }

        //Get call details
        $sql = "SELECT * from calls WHERE call_id = '$call_id'";

        $result = mysqli_query($link, $sql);

        while($row = mysqli_fetch_array($result, MYSQLI_BOTH))
        {
            $call_type = $row[2];
            $call_street1 = $row[3];
            $call_street2 = $row[4];
            $call_street3 = $row[5];
            $call_notes = $row[6];
        }


        echo '
            <p style="font-weight:bold">&nbsp&nbsp&nbspQuick Status Updates</p>
            <a class="btn btn-app"  id="enroute_btn">
                <i class="fa fa-car"></i> En Route
            </a>
            <a class="btn btn-app">
                <i class="fa fa-home"></i> On Scene
            </a>
            <a class="btn btn-app">
                <i class="fa fa-check"></i> Code 4
            </a>
            <a class="btn btn-app">
                <i class="fa fa-shield"></i> Subj. in Cust.
            </a>
            <a class="btn btn-app">
                <i class="fa fa-university"></i> En Route Jail
            </a>
            <a class="btn btn-app">
                <i class="fa fa-ambulance"></i> En Route Hospital
            </a>
            <a class="btn btn-app">
                <i class="fa fa-crosshairs" style="color:red"></i> 10-99
            </a>
            <br/><br/>

            <div class="form-group">
              <label class="col-lg-2 control-label">Incident ID</label>
              <div class="col-lg-10">
                <input type="text" id="call_id_det" name="call_id_det" class="form-control" value="'.$call_id.'" disabled>
              </div>
              <!-- ./ col-sm-9 -->
            </div>
            <br/>
            <!-- ./ form-group -->
            <div class="form-group">
              <label class="col-lg-2 control-label">Incident Type</label>
              <div class="col-lg-10">
                <input type="text" id="call_type_det" name="call_type_det" class="form-control" value="'.$call_type.'" disabled>
              </div>
              <!-- ./ col-sm-9 -->
            </div>
            <br/>
            <!-- ./ form-group -->
            <div class="form-group">
              <label class="col-lg-2 control-label">Street 1</label>
              <div class="col-lg-10">
                <input type="text" id="call_street1_det" name="call_street1_det" class="form-control" value="'.$call_street1.'" disabled>
              </div>
              <!-- ./ col-sm-9 -->
            </div>
            <br/>
            <!-- ./ form-group -->
            <div class="form-group">
              <label class="col-lg-2 control-label">Street 2</label>
              <div class="col-lg-10">
                <input type="text" id="call_street2_det" name="call_street2_det" class="form-control" value="'.$call_street2.'" disabled>
              </div>
              <!-- ./ col-sm-9 -->
            </div>
            <br/>
            <!-- ./ form-group -->
            <div class="form-group">
              <label class="col-lg-2 control-label">Street 3</label>
              <div class="col-lg-10">
                <input type="text" id="call_street3_det" name="call_street3_det" class="form-control" value="'.$call_street3.'" disabled>
              </div>
              <!-- ./ col-sm-9 -->
            </div>

            <div class="clearfix">
            <br/><br/><br/><br/>
            <!-- ./ form-group -->
            <div class="form-group">
              <label class="col-lg-2 control-label">Narrative</label>
              <div class="col-lg-10">
                <div name="call_narrative" id="call_narrative" contenteditable="false" style="background-color: #eee; opacity: 1; border: 1px solid #ccc; padding: 6px 12px; font-size: 14px;">'.$call_notes.'</div>
              </div>
              <!-- ./ col-sm-9 -->
            </div>
            <br/>
            <!-- ./ form-group -->
            <div class="form-group">
              <label class="col-lg-2 control-label">Add Narrative</label>
              <div class="col-lg-10">
                <textarea name="narrative_add" id="narrative_add" class="form-control" style="text-transform:uppercase" rows="2" required></textarea>
              </div>
              <!-- ./ col-sm-9 -->
            </div>
            <br/>
            <!-- ./ form-group -->

        ';
    }

    echo '
        </div>
        <!-- ./ x_content -->
        <br/>
        <div class="x_footer">

        </div>
        <!-- ./ x_footer -->
        </form>
    </div>
    <!-- ./ x_panel -->
</div>
<!-- ./ col-md-6 col-sm-6 col-xs-6 -->
    ';



}



//Checks to see if there are any active tones. Certain tones will add a session variable
function checkTones()
{
    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    if (!$link) {
        die('Could not connect: ' .mysql_error());
    }

    $sql = "SELECT * from tones";

    $result=mysqli_query($link, $sql);

    $encode = array();
    while($row = mysqli_fetch_array($result, MYSQLI_BOTH))
    {
        // If the tone is set to active
        if ($row[2] == "1")
        {
            $encode[$row[1]] = "ACTIVE";
        }
        else if ($row[2] == "0")
        {
            $encode[$row[1]] = "INACTIVE";
        }
    }

    mysqli_close($link);
    echo json_encode($encode);

}

function setTone()
{
    $tone = $_POST['tone'];
    $action = $_POST['action'];

    $status;
    switch ($action)
    {
        case "start":
            $status = '1';
            break;
        case "stop":
            $status = '0';
            break;
    }

    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    if (!$link) {
        die('Could not connect: ' .mysql_error());
    }

    $sql = "UPDATE tones SET active = ? WHERE name = ?";

    try {
        $stmt = mysqli_prepare($link, $sql);
        mysqli_stmt_bind_param($stmt, "ss", $status, $tone);
        $result = mysqli_stmt_execute($stmt);

        if ($result == FALSE) {
            die(mysqli_error($link));
        }
    }
    catch (Exception $e)
    {
        die("Failed to run query: " . $e->getMessage()); //TODO: A function to send me an email when this occurs should be made
    }

    mysqli_close($link);

    if ($action == "start")
    {
        echo "SUCCESS START";
    }
    else
    {
        echo "SUCCESS STOP";
    }

}

function logoutUser()
{
    $identifier = $_POST['unit'];

    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    if (!$link) {
        die('Could not connect: ' .mysql_error());
    }

    $sql = "DELETE FROM active_users WHERE identifier = ?";

    try {
        $stmt = mysqli_prepare($link, $sql);
        mysqli_stmt_bind_param($stmt, "s", $identifier);
        $result = mysqli_stmt_execute($stmt);

        if ($result == FALSE) {
            die(mysqli_error($link));
        }
    }
    catch (Exception $e)
    {
        die("Failed to run query: " . $e->getMessage()); //TODO: A function to send me an email when this occurs should be made
    }

    mysqli_close($link);
    echo "SUCCESS";

}

function changeStatus()
{

    //var_dump($_POST);

    $unit = $_POST['unit'];
    $status = $_POST['status'];
    $statusId;
    $statusDet;
    $onCall = false;

    switch ($status)
    {
        case "statusMeal":
            $statusId = '0';
            $statusDet = '4';
            break;
        case "statusOther":
            $statusId = '0';
            $statusDet = '2';
            break;
        case "statusAvailBusy":
            $statusId = '1';
            $statusDet = '1';
            $onCall = true;
            break;
		case "statusUnavailBusy":
            $statusId = '6';
            $statusDet = '6';
            $onCall = true;
            break;
        case "statusSig11":
            $statusId = '1';
            $statusDet = '5';
            break;
		case "statusArrivedOC":
            $statusId = '7';
            $statusDet = '7';
            $onCall = true;
            break;
		case "statusTransporting":
            $statusId = '8';
            $statusDet = '8';
            $onCall = true;
            break;

		case "10-65":
            $statusId = '8';
            $statusDet = '8';
            $onCall = true;
            break;
		case "10-23":
            $statusId = '7';
            $statusDet = '7';
            $onCall = true;
            break;
        case "10-8":
            $statusId = '1';
            $statusDet = '1';
            $onCall = true;
            break;
		case "10-7":
            $statusId = '6';
            $statusDet = '6';
            $onCall = false;
            break;
        case "10-6":
            $statusId = '0';
            $statusDet = '2';
            break;
        case "10-5":
            $statusId = '0';
            $statusDet = '4';
            break;
        case "sig11":
            $statusId = '1';
            $statusDet = '5';
            break;
    }

    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    if (!$link) {
        die('Could not connect: ' .mysql_error());
    }

    $sql = "UPDATE active_users SET status = ?, status_detail = ? WHERE identifier = ?";

    try {
        $stmt = mysqli_prepare($link, $sql);
        mysqli_stmt_bind_param($stmt, "iis", $statusId, $statusDet, $unit);
        $result = mysqli_stmt_execute($stmt);

        if ($result == FALSE) {
            die(mysqli_error($link));
        }
    }
    catch (Exception $e)
    {
        die("Failed to run query: " . $e->getMessage()); //TODO: A function to send me an email when this occurs should be made
    }

    if ($onCall)
    {
        //echo $unit;
        //Figure out what call they're on
        $sql = "SELECT call_id FROM calls_users WHERE identifier = \"$unit\"";

        $result=mysqli_query($link, $sql);

        while($row = mysqli_fetch_array($result, MYSQLI_BOTH))
        {
            $callId = $row[0];
        }

        //Get their callsign for the narrative
        $sql = "SELECT callsign FROM active_users WHERE identifier = \"$unit\"";

        $result=mysqli_query($link, $sql);

        while($row = mysqli_fetch_array($result, MYSQLI_BOTH))
        {
            $callsign = $row[0];
        }

        //Update the call_notes to say they were cleared
        $narrativeAdd = date("Y-m-d H:i:s").': Unit Cleared: '.$callsign.'<br/>';

        $sql = "UPDATE calls SET call_notes = concat(call_notes, ?) WHERE call_id = ?";

        try {
            $stmt = mysqli_prepare($link, $sql);
            mysqli_stmt_bind_param($stmt, "si", $narrativeAdd, $callId);
            $result = mysqli_stmt_execute($stmt);

            if ($result == FALSE) {
                die(mysqli_error($link));
            }
        }
        catch (Exception $e)
        {
            die("Failed to run query: " . $e->getMessage()); //TODO: A function to send me an email when this occurs should be made
        }


       //Remove them from the call
       $sql = "DELETE FROM calls_users WHERE identifier = ?";

        try {
            $stmt = mysqli_prepare($link, $sql);
            mysqli_stmt_bind_param($stmt, "s", $unit);
            $result = mysqli_stmt_execute($stmt);

            if ($result == FALSE) {
                die(mysqli_error($link));
            }
        }
        catch (Exception $e)
        {
            die("Failed to run query: " . $e->getMessage()); //TODO: A function to send me an email when this occurs should be made
        }
    }

    mysqli_close($link);
    echo "SUCCESS";
}

function deleteDispatcher()
{
    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    if (!$link) {
        die('Could not connect: ' .mysql_error());
    }

    $identifier = $_SESSION['identifier'];


mysqli_query($link,"DELETE FROM dispatchers WHERE identifier='".$identifier."'");
mysqli_close($link);

}

function setDispatcher($dep)
{
    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    if (!$link) {
        die('Could not connect: ' .mysql_error());
    }

    $identifier = $_SESSION['identifier'];

    $status;
    switch($dep)
    {
        case "1":
            $status = "0";
            break;
        case "2":
            $status = "1";
            break;
    }

    deleteDispatcher();

    $sql = "INSERT INTO dispatchers (identifier, callsign, status) VALUES (?, ?, ?)";


    try {
        $stmt = mysqli_prepare($link, $sql);
        mysqli_stmt_bind_param($stmt, "sss", $identifier, $identifier, $status);
        $result = mysqli_stmt_execute($stmt);

        if ($result == FALSE) {
            die(mysqli_error($link));
        }
    }
    catch (Exception $e)
    {
        die("Failed to run query: " . $e->getMessage()); //TODO: A function to send me an email when this occurs should be made
    }

}

function getDispatchers()
{
    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    if (!$link) {
        die('Could not connect: ' .mysql_error());
    }

    $sql = "SELECT * from dispatchers WHERE status = '1'";

    $result = mysqli_query($link, $sql);

    $num_rows = $result->num_rows;

    if($num_rows == 0)
    {
        echo "<div class=\"alert alert-danger\"><span>No available units</span></div>";
    }
    else
    {

    echo '
            <table id="dispatchersTable" class="table table-striped table-bordered">
            <thead>
                <tr>
                <th>Identifier</th>
                </tr>
            </thead>
            <tbody>
        ';
        while($row = mysqli_fetch_array($result, MYSQLI_BOTH))
        {
            echo '
            <tr>
                <td>'.$row[0].'</td>
            </tr>
            ';
        }

        echo '
            </tbody>
            </table>
        ';
    mysqli_close($link);
}
}
function setUnitActive($dep)
{
    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    if (!$link) {
        die('Could not connect: ' .mysql_error());
    }

    $identifier = $_SESSION['identifier'];

    $status;
    switch($dep)
    {
        case "1":
            $status = "1";
            break;
        case "2":
            $status = "2";
            break;
    }

    $sql = "REPLACE INTO active_users (identifier, callsign, status, status_detail) VALUES (?, ?, ?, '6')";


    try {
        $stmt = mysqli_prepare($link, $sql);
        mysqli_stmt_bind_param($stmt, "ssi", $identifier, $identifier, $status);
        $result = mysqli_stmt_execute($stmt);

        if ($result == FALSE) {
            die(mysqli_error($link));
        }
    }
    catch (Exception $e)
    {
        die("Failed to run query: " . $e->getMessage()); //TODO: A function to send me an email when this occurs should be made
    }

}

function getAvailableUnits()
{
    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    if (!$link) {
        die('Could not connect: ' .mysql_error());
    }

    $sql = "SELECT * from active_users WHERE status = '1'";

    $result = mysqli_query($link, $sql);

    $num_rows = $result->num_rows;

    if($num_rows == 0)
    {
        echo "<div class=\"alert alert-danger\"><span>No available units</span></div>";
    }
    else
    {

    echo '
            <table id="activeUsers" class="table table-striped table-bordered">
            <thead>
                <tr>
                <th>Identifier</th>
                <th>Callsign</th>
                <th>Action</th>
                </tr>
            </thead>
            <tbody>
        ';


        $counter = 0;
        while($row = mysqli_fetch_array($result, MYSQLI_BOTH))
        {
            echo '
            <tr>
                <td>'.$row[0].'</td>
                <td>'.$row[1].'</td>
                <td>
                <div class="dropdown"><button class="btn btn-link dropdown-toggle nopadding" type="button" data-toggle="dropdown">Status <span class="caret"></span></button><ul class="dropdown-menu">
                    <li><a id="statusMeal'.$counter.'" class="statusMeal '.$row[0].'" onclick="testFunction(this);">10-5/Meal Break</a></li>
                    <li><a id="statusOther'.$counter.'" class="statusOther '.$row[0].'" onclick="testFunction(this);">10-6/Other</a></li>
                    <li><a id="statusSig11'.$counter.'" class="statusSig11 '.$row[0].'" onclick="testFunction(this);">Signal 11</a></li>
                </ul></div>

                </td>
                <input name="uid" type="hidden" value='.$row[0].' />
            </tr>
            ';
            $counter++;
        }

        echo '
            </tbody>
            </table>
        ';
    }
    mysqli_close($link);
}

function getUnAvailableUnits()
{
    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    if (!$link) {
        die('Could not connect: ' .mysql_error());
    }

    $sql = "SELECT * from active_users WHERE status = '0'";

    $result = mysqli_query($link, $sql);

    $num_rows = $result->num_rows;

    if($num_rows == 0)
    {
        echo "<div class=\"alert alert-info\"><span>No unavailable units</span></div>";
    }
    else
    {
        echo '
                <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                    <th>Identifier</th>
                    <th>Callsign</th>
                    <th>Status</th>
                    <th>Action</th>
                    </tr>
                </thead>
                <tbody>
            ';



            while($row = mysqli_fetch_array($result, MYSQLI_BOTH))
            {
                echo '
                <tr>
                    <td>'.$row[0].'</td>
                    <td>'.$row[1].'</td>
                    <td>';

                        getIndividualStatus($row[1]);

                    echo '</td>

                    <td>
                    <a id="logoutUser" class="nopadding logoutUser '.$row[0].'" onclick="logoutUser(this);" style="color:red; cursor:pointer;">Logout</a>&nbsp;&nbsp;&nbsp;
                    <div class="dropdown"><button class="btn btn-link dropdown-toggle nopadding" style="display: inline-block; vertical-align:top;" type="button" data-toggle="dropdown">Status <span class="caret"></span></button><ul class="dropdown-menu">
                        <li><a id="statusAvail" class="statusAvailBusy '.$row[0].'" onclick="testFunction(this);">10-8/Available</a></li>
                    </ul></div>
                    </td>
                    <input name="uid" type="hidden" value='.$row[0].' />
                </tr>
                ';
            }

            echo '
                </tbody>
                </table>
            ';

      }
    mysqli_close($link);
}

function getIndividualStatus($callsign)
{
    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    if (!$link) {
        die('Could not connect: ' .mysql_error());
    }

    $sql = "SELECT status_detail FROM active_users WHERE callsign = \"$callsign\"";

    $result=mysqli_query($link, $sql);

    while($row = mysqli_fetch_array($result, MYSQLI_BOTH))
    {
        $statusDetail = $row[0];
    }

    $sql = "SELECT status_text FROM statuses WHERE status_id = \"$statusDetail\"";

    $result=mysqli_query($link, $sql);

    while($row = mysqli_fetch_array($result, MYSQLI_BOTH))
    {
        $statusText = $row[0];
    }

    echo $statusText;
}

function getIncidentType()
{
    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    if (!$link) {
        die('Could not connect: ' .mysql_error());
    }

    $sql = "SELECT code_name FROM incident_type";

    $result=mysqli_query($link, $sql);

    while($row = mysqli_fetch_array($result, MYSQLI_BOTH))
    {
        echo '<option value="'.$row[0].'">'.$row[0].'</option>';
    }
}

function getStreet()
{
    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    if (!$link) {
        die('Could not connect: ' .mysql_error());
    }

    $sql = "SELECT name FROM streets";

    $result=mysqli_query($link, $sql);

    while($row = mysqli_fetch_array($result, MYSQLI_BOTH))
    {
        echo '<option value="'.$row[0].'">'.$row[0].'</option>';
    }
}

function getActiveUnits()
{
    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    if (!$link) {
        die('Could not connect: ' .mysql_error());
    }

    $query = "SELECT callsign FROM active_users WHERE status = '1'";

    $result=mysqli_query($link, $query);

    $encode = array();
    while($row = mysqli_fetch_array($result, MYSQLI_BOTH))
    {
        $encode[$row[0]] = $row[0];
    }

    echo json_encode($encode);
}

function getActiveUnitsModal()
{
    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    if (!$link) {
        die('Could not connect: ' .mysql_error());
    }

    $query = "SELECT callsign, identifier FROM active_users WHERE status = '1'";

    $result=mysqli_query($link, $query);

    $encode = array();
    while($row = mysqli_fetch_array($result, MYSQLI_BOTH))
    {
        $encode[$row[1]] = $row[0];
    }

    echo json_encode($encode);
}

function getActiveCalls()
{
    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    if (!$link) {
        die('Could not connect: ' .mysql_error());
    }

    $sql = "SELECT * from calls";

    $result = mysqli_query($link, $sql);

    $num_rows = $result->num_rows;

    if($num_rows == 0)
    {
        echo '<div class="alert alert-info"><span>No active calls</span></div>';
    }
    else
    {
        echo '<table id="activeCalls" class="table table-striped table-bordered">
            <thead>
                <tr>
                <th>Call ID</th>
                <th>Call Type</th>
                <th>Units</th>
                <th>Location</th>
                <th>Actions</th>
                </tr>
            </thead>
            <tbody>
        ';


        $counter = 0;
        while($row = mysqli_fetch_array($result, MYSQLI_BOTH))
        {
            echo '
            <tr id="'.$counter.'">
                <td>'.$row[0].'</td>';

                //Issue #28. Check if $row[1] == bolo. If so, change text color to orange
                if ($row[1] == "BOLO")
                {
                    echo '<td style="color:orange;">'.$row[1].'</td>';
                    echo '<td><!--Leave blank--></td>';
                }
                else
                {
                    echo '<td>'.$row[1].'</td>';
                    echo '
                        <td>';
                            getUnitsOnCall($row[0]);
                        echo '</td>';
                }


                echo '<td>'.$row[2].'/'.$row[3].'/'.$row[4].'</td>';

                if (isset($_GET['type']) && $_GET['type'] == "responder")
                {
                    echo'
                    <td>
                        <button id="'.$row[0].'" class="btn-link" name="call_details_btn" data-toggle="modal" data-target="#callDetails">Details</button>
                    </td>';
                }
                else
                {
                echo'
                <td>
                    <button id="'.$row[0].'" class="btn-link" style="color: red;" value="'.$row[0].'" onclick="clearCall('.$row[0].')">Clear</button>
                    <button id="'.$row[0].'" class="btn-link" name="call_details_btn" data-toggle="modal" data-target="#callDetails">Details</button>
                    <input id="'.$row[0].'" type="submit" name="assign_unit" data-toggle="modal" data-target="#assign" class="btn-link '.$row[0].'" value="Assign"/>
                    <input name="uid" name="uid" type="hidden" value="'.$row[0].'"/>
                </td>';
                }

            echo'
            </tr>
            ';
            $counter++;
        }

        echo '
            </tbody>
            </table>
        ';

    }
    mysqli_close($link);

}

function getUnitsOnCall($callId)
{
    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    if (!$link) {
        die('Could not connect: ' .mysql_error());
    }

    $sql1 = "SELECT * FROM calls_users WHERE call_id = \"$callId\"";

    $result1=mysqli_query($link, $sql1);

    $units = "";

    $num_rows = $result1->num_rows;

    if($num_rows == 0)
    {
        $units = '<span style="color: red;">Unassigned</span>';
    }
    else
    {
        while($row1 = mysqli_fetch_array($result1, MYSQLI_BOTH))
        {
            $units = $units.''.$row1[2].', ';
        }
    }



    echo $units;

    mysqli_close($link);
}

function getCallDetails()
{
    $callId = $_GET['callId'];

    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    if (!$link) {
        die('Could not connect: ' .mysql_error());
    }

    $sql = "SELECT * FROM calls WHERE call_id = \"$callId\"";

    $result=mysqli_query($link, $sql);

    $encode = array();
    while($row = mysqli_fetch_array($result, MYSQLI_BOTH))
    {
        $encode["call_id"] = $row[0];
        $encode["call_type"] = $row[1];
        $encode["call_street1"] = $row[2];
        $encode["call_street2"] = $row[3];
        $encode["call_street3"] = $row[4];
        $encode["narrative"] = $row[5];

    }

    echo json_encode($encode);
    mysqli_close($link);
}

function getCivilianNamesOption()
{
    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    if (!$link) {
        die('Could not connect: ' .mysql_error());
    }

    $sql = "SELECT id, first_name, last_name FROM ncic_names";

    $result=mysqli_query($link, $sql);

    while($row = mysqli_fetch_array($result, MYSQLI_BOTH))
    {
        echo "<option value=".$row[0].">".$row[1]." ".$row[2]."</option>";
    }
}

function getCitations()
{
    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    if (!$link) {
        die('Could not connect: ' .mysql_error());
    }

    $sql = "SELECT citation_name FROM citations";

    $result=mysqli_query($link, $sql);

    while($row = mysqli_fetch_array($result, MYSQLI_BOTH))
    {
        echo '<option value="'.$row[0].'">'.$row[0].'</option>';
    }
}

/**#@+
 * function getVehicleMakes()
 *
 * Querys database to retrieve all vehicle makes.
 *
 * @since 1.0a RC2
 */
function getVehicleMakes()
{
    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    if (!$link) {
        die('Could not connect: ' .mysql_error());
    }

    $query = "SELECT DISTINCT vehicles.Make FROM vehicles";

    $result=mysqli_query($link, $query);

    $num_rows = $result->num_rows;

    while($row = mysqli_fetch_array($result, MYSQLI_BOTH))
    {
        echo '<option value="'.$row[0].'">'.$row[0].'</option>';
    }
}


/**#@+
 * function getVehicleModels()
 *
 * Querys database to retrieve all vehicle models.
 *
 * @since 1.0a RC2
 */
function getVehicleModels()
{
    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    if (!$link) {
        die('Could not connect: ' .mysql_error());
    }

    $query = "SELECT DISTINCT vehicles.Model FROM vehicles";

    $result=mysqli_query($link, $query);

    $num_rows = $result->num_rows;

    while($row = mysqli_fetch_array($result, MYSQLI_BOTH))
    {
        echo '<option value="'.$row[0].'">'.$row[0].'</option>';
    }
}


/**#@+
 * function getGenders()
 *
 * Querys database to retrieve genders.
 *
 * @since 1.0a RC2
 */
function getGenders()
{
    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    if (!$link) {
        die('Could not connect: ' .mysql_error());
    }

    $query = "SELECT DISTINCT genders.genders FROM genders";

    $result=mysqli_query($link, $query);

    $num_rows = $result->num_rows;

    while($row = mysqli_fetch_array($result, MYSQLI_BOTH))
    {
        echo '<option value="'.$row[0].'">'.$row[0].'</option>';
    }
}

/**#@+
 * function getColors()
 *
 * Querys database to retrieve genders.
 *
 * @since 1.0a RC2
 */
function getColors()
{
    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    if (!$link) {
        die('Could not connect: ' .mysql_error());
    }

    $query = "SELECT color_group, color_name FROM colors";

    $result=mysqli_query($link, $query);

    $num_rows = $result->num_rows;

    while($row = mysqli_fetch_array($result, MYSQLI_BOTH))
    {
        echo '<option value="'.$row[0].'-'.$row[1].'">'.$row[0].'-'.$row[1].'</option>';
    }
}


function getCivilianNames()
{
    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

	if (!$link) {
		die('Could not connect: ' .mysql_error());
	}

	$sql = "SELECT ncic_names.id, ncic_names.first_name, ncic_names.last_name FROM ncic_names";

	$result=mysqli_query($link, $sql);

	while($row = mysqli_fetch_array($result, MYSQLI_BOTH))
	{
		echo "<option value=\"$row[0]\">$row[1] $row[2]</option>";
	}
	mysqli_close($link);
}

function getAgencies()
{
    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

	if (!$link) {
		die('Could not connect: ' .mysql_error());
	}

	$sql = 'SELECT * FROM departments
            WHERE department_name <>"Administrators"
            AND department_name <>"EMS"
            AND department_name <>"Fire"
            AND department_name <>"Civilian"
            AND department_name <>"Communications (Dispatch)"
            AND department_name <>"Head Administrators"';

	$result=mysqli_query($link, $sql);

	while($row = mysqli_fetch_array($result, MYSQLI_BOTH))
	{
		echo "<option value=\"$row[1]\">$row[1]</option>";
	}
	mysqli_close($link);
}

?>
