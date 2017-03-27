<?php
$iniContents = parse_ini_file("../properties/config.ini", true); //Gather from config.ini file
$connectionsFileLocation = $_SERVER["DOCUMENT_ROOT"]."/openCad/".$iniContents['main']['connection_file_location'];

require($connectionsFileLocation);

if (isset($_GET['getCivilianDetails']))
{
    getCivilianDetails();
}

if (isset($_POST['requestIdentity']))
{
    requestIdentity();
}

//Function to request an identity
function requestIdentity()
{
    var_dump($_POST);


    /*
    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	
    if (!$link) { 
        die('Could not connect: ' .mysql_error());
    }
    
    $query = 'SELECT civilian_names.*, ncic_names.first_name, ncic_names.last_name, ncic_plates.veh_plate, ncic_plates.veh_make, ncic_plates.veh_model, ncic_plates.veh_color FROM `ncic_names` LEFT JOIN `civilian_names` ON `civilian_names`.`names_id` = `ncic_names`.`id` LEFT JOIN `ncic_plates` ON `ncic_plates`.`name_id` = `ncic_names`.`id` WHERE civilian_names.user_id = "'.$uid.'"';

    $result=mysqli_query($link, $query);

    $num_rows = $result->num_rows;

    if($num_rows == 0)
    {
        echo "<div class=\"alert alert-info\"><span>You currently have no identities</span></div>";
    }
*/
}

function getIdentities()
{
    //session_start();
    $uid = $_SESSION['id'];

    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	
    if (!$link) { 
        die('Could not connect: ' .mysql_error());
    }
    
    $query = 'SELECT civilian_names.*, ncic_names.first_name, ncic_names.last_name, ncic_plates.veh_plate, ncic_plates.veh_make, ncic_plates.veh_model, ncic_plates.veh_color FROM `ncic_names` LEFT JOIN `civilian_names` ON `civilian_names`.`names_id` = `ncic_names`.`id` LEFT JOIN `ncic_plates` ON `ncic_plates`.`name_id` = `ncic_names`.`id` WHERE civilian_names.user_id = "'.$uid.'"';

    $result=mysqli_query($link, $query);

    $num_rows = $result->num_rows;

    if($num_rows == 0)
    {
        echo "<div class=\"alert alert-info\"><span>You currently have no identities</span></div>";
    }
    else
    {
        echo '
            <table id="identities" class="table table-striped">
            <thead>
                <tr>
                <th>Name</th>
                <th>Assigned Vehicle Plate</th>
                <th>Vehicle Make, Model, and Color</th>
                <th>Assigned Firearm</th>
                <th>Actions</th>
                </tr>
            </thead>
            <tbody>           
        ';

        while($row = mysqli_fetch_array($result, MYSQLI_BOTH))
        {
            echo '
            <tr>
                <td>'.$row[2].' '.$row[3].'</td>
                <td>'.$row[4].'</td>
                <td>'.$row[7].', '.$row[5].' '.$row[6].'</td>
                <td>N/A</td>
                <td>
                    <form action="../actions/civActions.php" method="get">
                    <button name="civilianDetails" type="button" data-toggle="modal" id="'.$row[1].'" data-target="#civilianDetailsModal" class="btn btn-xs btn-link">Details</button>
                    </form>                    
                </td>
            </tr>
            ';
        }

        echo '
            </tbody>
            </table>
        ';
    }
}

function getCivilianDetails()
{
    $name_id = $_GET['name_id'];

    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	
    if (!$link) { 
        die('Could not connect: ' .mysql_error());
    }
    
    $query = 'SELECT ncic_names.*, ncic_plates.* FROM `ncic_names` LEFT JOIN `ncic_plates` ON `ncic_plates`.`name_id` = `ncic_names`.`id` WHERE ncic_names.id = "'.$name_id.'"';

    $result=mysqli_query($link, $query);
    
    $encode = array();
    while($row = mysqli_fetch_array($result, MYSQLI_BOTH))
    {
        $encode["nameId"] = $row[0];
        $encode["name"] = $row[1].' '.$row[2];
        $encode["dob"] = $row[3];
        $encode["address"] = $row[4];
        $encode["sex"] = $row[5];
        $encode["race"] = $row[6];
        $encode["hair_color"] = $row[8];
        $encode["build"] = $row[9];
        $encode["veh_plate"] = $row[12];
        $encode["veh_make"] = $row[13];
        $encode["veh_model"] = $row[14];
        $encode["veh_color"] = $row[15];
        $encode["veh_reg_state"] = $row[18];
        
    }
    
    echo json_encode($encode);
    mysqli_close($link);
}


?>