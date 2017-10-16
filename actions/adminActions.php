<?php
/**
 Open source CAD system for RolePlaying Communities.
 Copyright (C) 2017 Shane Gill
 This program is free software: you can redistribute it and/or modify
 it under the terms of the GNU General Public License as published by
 the Free Software Foundation, either version 3 of the License, or
 (at your option) any later version.
 This program comes with ABSOLUTELY NO WARRANTY; Use at your own risk.
 *
 */

require_once(__DIR__ . "/../oc-config.php");

/*
This file handles all actions for admin.php script
*/

/* Handle POST requests */
if (isset($_POST['approveUser']))
{
    approveUser();
}
if (isset($_POST['rejectUser']))
{
    rejectUser();
}
if (isset($_POST['suspendUser']))
{
    suspendUser();
}
if (isset($_POST['reactivateUser']))
{
    reactivateUser();
}
if (isset($_POST['deleteUser']))
{
    delete_user();
}
if (isset($_POST['getUserDetails']))
{
    getUserDetails();
}
if (isset($_POST['delete_callhistory']))
{
    delete_callhistory();
}

/* FUNCTIONS */

function getRanks()
{
    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    $site = BASE_URL;
    if (!$link)
    {
        die('Could not connect: ' . mysql_error());
    }

    $query = "SELECT * FROM ranks";

    $result = mysqli_query($link, $query);

    echo '
        <table id="ranks" class="table table-striped table-bordered">
        <thead>
            <tr>
            <th>Rank ID</th>
            <th>Rank Name</th>
            <th>User Can Choose <i class="fa fa-question-circle" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="This indicates whether or not regular users may select this rank for themselves"></i></th>
            </tr>
        </thead>
        <tbody>
    ';

    while ($row = mysqli_fetch_array($result, MYSQLI_BOTH))
    {
        echo '
        <tr>
            <td>' . $row[0] . '</td>
            <td>' . $row[1] . '</td>';

        switch ($row[2])
        {
            case "1":
                echo "<td>True</td>";
            break;
            case "0":
                echo "<td>False</td>";
            break;
        }

        echo '
        </tr>
        ';
    }

    echo '
        </tbody>
        </table>
    ';
}

function delete_user()
{
    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    $site = BASE_URL;
    if (!$link)
    {
        die('Could not connect: ' . mysql_error());
    }

    $uid = $_POST['uid'];
    echo $uid;

    $query = "DELETE FROM users WHERE id = ?";

    try
    {
        $stmt = mysqli_prepare($link, $query);
        mysqli_stmt_bind_param($stmt, "i", $uid);
        $result = mysqli_stmt_execute($stmt);

        if ($result == false)
        {
            die(mysqli_error($link));
        }
    }
    catch(Exception $e)
    {
        die("Failed to run query: " . $e->getMessage());
    }

    session_start();
    $_SESSION['userMessage'] = '<div class="alert alert-success"><span>Successfully removed user from database</span></div>';
    header("Location: ../oc-admin/userManagement.php#user_panel");
}

/* Gets the user count. Returns value */
function getUserCount()
{
    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    $site = BASE_URL;
    if (!$link)
    {
        die('Could not connect: ' . mysql_error());
    }

    $query = "SELECT COUNT(*) from users";

    $result = mysqli_query($link, $query);
    $row = mysqli_fetch_array($result, MYSQLI_BOTH);

    mysqli_close($link);

    return $row[0];
}

function getPendingUsers()
{
    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    $site = BASE_URL;
    if (!$link)
    {
        die('Could not connect: ' . mysql_error());
    }

    $query = "SELECT id, name, email, identifier FROM users WHERE approved = '0'";

    $result = mysqli_query($link, $query);

    $num_rows = $result->num_rows;

    if ($num_rows == 0)
    {
        echo "<div class=\"alert alert-info\"><span>There are currently no access requests</span></div>";
    }
    else
    {
        echo '
            <table id="pendingUsers" class="table table-striped table-bordered">
            <thead>
                <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Identifier</th>
                <th>Groups</th>
                <th>Actions</th>
                </tr>
            </thead>
            <tbody>
        ';

        while ($row = mysqli_fetch_array($result, MYSQLI_BOTH))
        {
            echo '
            <tr>
                <td>' . $row[1] . '</td>
                <td>' . $row[2] . '</td>
                <td>' . $row[3] . '</td>
                <td>';

            getUserGroups($row[0]);

            echo ' </td>
                <td>
                    <form action="'.$site.'/actions/adminActions.php" method="post">
                    <input name="approveUser" type="submit" class="btn btn-xs btn-link" value="Approve" />
                    <input name="rejectUser" type="submit" class="btn btn-xs btn-link" value="Reject" />
                    <input name="uid" type="hidden" value=' . $row[0] . ' />
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

function getDepartments()
{
    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    $site = BASE_URL;
    if (!$link)
    {
        die('Could not connect: ' . mysql_error());
    }

    $sql = 'SELECT * from departments WHERE department_name <>"EMS"';

    $result = mysqli_query($link, $sql);

    while ($row = mysqli_fetch_array($result, MYSQLI_BOTH))
    {
        if ($row[0] == '0' || $row[0] == '8')
        {
            echo '<option value="' . $row[0] . '" disabled>' . $row[1] . '</option>';
        }
        else
        {
            echo '<option value="' . $row[0] . '">' . $row[1] . '</option>';
        }

    }
}

/* Get from temp table */
function getUserGroups($uid)
{
    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    $site = BASE_URL;
    if (!$link)
    {
        die('Could not connect: ' . mysql_error());
    }

    $sql = "SELECT departments.department_name FROM user_departments_temp INNER JOIN departments on user_departments_temp.department_id=departments.department_id WHERE user_departments_temp.user_id = \"$uid\"";

    $result1 = mysqli_query($link, $sql);

    while ($row1 = mysqli_fetch_array($result1, MYSQLI_BOTH))
    {
        echo $row1[0] . "<br/>";
    }
}

/* Get from perm table */
function getUserGroupsApproved($uid)
{
    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    $site = BASE_URL;
    if (!$link)
    {
        die('Could not connect: ' . mysql_error());
    }

    $sql = "SELECT departments.department_name FROM user_departments INNER JOIN departments on user_departments.department_id=departments.department_id WHERE user_departments.user_id = \"$uid\"";

    $result1 = mysqli_query($link, $sql);

    while ($row1 = mysqli_fetch_array($result1, MYSQLI_BOTH))
    {
        echo $row1[0] . "<br/>";
    }
}

function approveUser()
{
    $uid = $_POST['uid'];
    $site = BASE_URL;
    /* If a user has been approved, the following needs to be done:
    1. Insert user's groups from temp table to regular table
    2. Set user's approved status to 1
    */

    /* Copy from temp table to regular table */
    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    if (!$link)
    {
        die('Could not connect: ' . mysql_error());
    }

    //Insert into user_departments
    $query = "INSERT INTO user_departments SELECT u.* FROM user_departments_temp u WHERE user_id = ?";

    try
    {
        $stmt = mysqli_prepare($link, $query);
        mysqli_stmt_bind_param($stmt, "i", $uid);
        $result = mysqli_stmt_execute($stmt);

        if ($result == false)
        {
            die(mysqli_error($link));
        }
    }
    catch(Exception $e)
    {
        die("Failed to run query: " . $e->getMessage());
    }

    /* Delete from user_departments_temp */
    $query = "DELETE FROM user_departments_temp WHERE user_id = ?";

    try
    {
        $stmt = mysqli_prepare($link, $query);
        mysqli_stmt_bind_param($stmt, "i", $uid);
        $result = mysqli_stmt_execute($stmt);

        if ($result == false)
        {
            die(mysqli_error($link));
        }
    }
    catch(Exception $e)
    {
        die("Failed to run query: " . $e->getMessage());
    }

    /* Set user's approved status */
    $query = "UPDATE users SET approved = '1' WHERE id = ?";

    try
    {
        $stmt = mysqli_prepare($link, $query);
        mysqli_stmt_bind_param($stmt, "i", $uid);
        $result = mysqli_stmt_execute($stmt);

        if ($result == false)
        {
            die(mysqli_error($link));
        }
    }
    catch(Exception $e)
    {
        die("Failed to run query: " . $e->getMessage());
    }

    mysqli_close($link);

    session_start();
    $_SESSION['accessMessage'] = '<div class="alert alert-success"><span>Successfully approved user access</span></div>';

    sleep(1);
    header("Location:../oc-admin/admin.php");

}

function rejectUser()
{
    /* If a user has been rejected, the following needs to be done:
    1. Delete user's group's from user_departments_temp table
    2. Delete user's profile from users table
    */
    $uid = $_POST['uid'];

    /* Delete groups from temp table */
    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    $site = BASE_URL;
    if (!$link)
    {
        die('Could not connect: ' . mysql_error());
    }

    $query = "DELETE FROM user_departments_temp where user_id = ?";

    try
    {
        $stmt = mysqli_prepare($link, $query);
        mysqli_stmt_bind_param($stmt, "i", $uid);
        $result = mysqli_stmt_execute($stmt);

        if ($result == false)
        {
            die(mysqli_error($link));
        }
    }
    catch(Exception $e)
    {
        die("Failed to run query: " . $e->getMessage());
    }

    /* Delete user from user table */

    $query = "DELETE FROM users where id = ?";

    try
    {
        $stmt = mysqli_prepare($link, $query);
        mysqli_stmt_bind_param($stmt, "i", $uid);
        $result = mysqli_stmt_execute($stmt);

        if ($result == false)
        {
            die(mysqli_error($link));
        }
    }
    catch(Exception $e)
    {
        die("Failed to run query: " . $e->getMessage());
    }

    mysqli_close($link);

    session_start();
    $_SESSION['accessMessage'] = '<div class="alert alert-danger"><span>Successfully rejected user access</span></div>';

    sleep(1);
    header("Location:../oc-admin/admin.php");

}

function getGroupCount($gid)
{
    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    $site = BASE_URL;
    if (!$link)
    {
        die('Could not connect: ' . mysql_error());
    }

    $query = "SELECT COUNT(*) from user_departments WHERE department_id = \"$gid\"";

    $result = mysqli_query($link, $query);
    $row = mysqli_fetch_array($result, MYSQLI_BOTH);

    mysqli_close($link);

    return $row[0];
}

/* NOTE: This function will only build table for users with status 1 & 2. Unapproved users will not be included in this list */
function getUsers()
{
    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    $site = BASE_URL;
    if (!$link)
    {
        die('Could not connect: ' . mysql_error());
    }

    $query = "SELECT id, name, email, identifier, approved FROM users WHERE approved = '1' OR approved = '2'";

    $result = mysqli_query($link, $query);

    echo '
        <table id="allUsers" class="table table-striped table-bordered">
        <thead>
            <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Identifier</th>
            <th>Groups</th>
            <th>Actions</th>
            </tr>
        </thead>
        <tbody>
    ';

    while ($row = mysqli_fetch_array($result, MYSQLI_BOTH))
    {
        echo '
        <tr>
            <td>' . $row[1] . '</td>
            <td>' . $row[2] . '</td>
            <td>' . $row[3] . '</td>
            <td>';

        getUserGroupsApproved($row[0]);

        echo ' </td>
            <td>
                <form action="'.$site.'/actions/adminActions.php" method="post">
                <button name="editUser" type="button" data-toggle="modal" id="' . $row[0] . '" data-target="#editUserModal" class="btn btn-xs btn-link">Edit</button>
                <input name="deleteUser" type="submit" class="btn btn-xs btn-link" onclick="deleteUser(' . $row[0] . ')" value="Delete" />
                ';
        if ($row[4] == '2')
        {
            echo '<input name="reactivateUser" type="submit" class="btn btn-xs btn-link" value="Reactivate" />';
        }
        else
        {
            echo '<input name="suspendUser" type="submit" class="btn btn-xs btn-link" value="Suspend" />';
        }
        echo '

                <input name="uid" type="hidden" value=' . $row[0] . ' />
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

//Function to suspend a user account
// TODO: Add reason, duration
function suspendUser()
{
    $uid = $_POST['uid'];
    $site = BASE_URL;
    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    if (!$link)
    {
        die('Could not connect: ' . mysql_error());
    }

    $query = "UPDATE users SET approved = '2' WHERE id = ?";

    try
    {
        $stmt = mysqli_prepare($link, $query);
        mysqli_stmt_bind_param($stmt, "i", $uid);
        $result = mysqli_stmt_execute($stmt);

        if ($result == false)
        {
            die(mysqli_error($link));
        }
    }
    catch(Exception $e)
    {
        die("Failed to run query: " . $e->getMessage());
    }

    mysqli_close($link);

    session_start();
    $_SESSION['accessMessage'] = '<div class="alert alert-success"><span>Successfully suspended user account</span></div>';

    sleep(1);
    header("Location:../oc-admin/userManagement.php");
}

function reactivateUser()
{
    $uid = $_POST['uid'];
    $site = BASE_URL;
    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    if (!$link)
    {
        die('Could not connect: ' . mysql_error());
    }

    $query = "UPDATE users SET approved = '1' WHERE id = ?";

    try
    {
        $stmt = mysqli_prepare($link, $query);
        mysqli_stmt_bind_param($stmt, "i", $uid);
        $result = mysqli_stmt_execute($stmt);

        if ($result == false)
        {
            die(mysqli_error($link));
        }
    }
    catch(Exception $e)
    {
        die("Failed to run query: " . $e->getMessage());
    }

    mysqli_close($link);

    session_start();
    $_SESSION['accessMessage'] = '<div class="alert alert-success"><span>Successfully reactivated user account</span></div>';

    sleep(1);
    header("Location:../oc-admin/userManagement.php");
}

function getUserDetails()
{
    $userId = $_POST['userId'];
    $site = BASE_URL;
    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    if (!$link)
    {
        die('Could not connect: ' . mysql_error());
    }

    $sql = "SELECT id, name, email, identifier FROM users WHERE ID = $userId";

    $result = mysqli_query($link, $sql);

    $encode = array();
    while ($row = mysqli_fetch_array($result, MYSQLI_BOTH))
    {
        $encode["userId"] = $row[0];
        $encode["name"] = $row[1];
        $encode["email"] = $row[2];
        $encode["identifier"] = $row[3];

    }

    mysqli_close($link);
    //Pass the array and userID to getUserGroupsEditor which will return it
    getUserGroupsEditor($encode, $userId);

}

function getUserGroupsEditor($encode, $userId)
{
    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    $site = BASE_URL;
    if (!$link)
    {
        die('Could not connect: ' . mysql_error());
    }

    $sql = "SELECT departments.department_name FROM user_departments INNER JOIN departments on user_departments.department_id=departments.department_id WHERE user_departments.user_id = \"$userId\"";

    $result = mysqli_query($link, $sql);

    $counter = 0;
    while ($row = mysqli_fetch_array($result, MYSQLI_BOTH))
    {
        $encode["department"][$counter] = $row[0];
        $counter++;
    }

    echo json_encode($encode);

    mysqli_close($link);
}

function getStreetNames()
{
    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    $site = BASE_URL;
    if (!$link)
    {
        die('Could not connect: ' . mysql_error());
    }

    $query = "SELECT name, county FROM streets";

    $result = mysqli_query($link, $query);

    echo '
        <table id="streets" class="table table-striped table-bordered">
        <thead>
            <tr>
            <th>Name</th>
            <th>County</th>
            </tr>
        </thead>
        <tbody>
    ';

    while ($row = mysqli_fetch_array($result, MYSQLI_BOTH))
    {
        echo '
        <tr>
            <td>' . $row[0] . '</td>
            <td>' . $row[1] . '</td>
        </tr>
        ';
    }

    echo '
        </tbody>
        </table>
    ';
}

function getCodes()
{
    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    $site = BASE_URL;
    if (!$link)
    {
        die('Could not connect: ' . mysql_error());
    }

    $query = "SELECT code_id, code_name FROM codes";

    $result = mysqli_query($link, $query);

    echo '
        <table id="codes" class="table table-striped table-bordered">
        <thead>
            <tr>
            <th>Code ID</th>
            <th>Code Name</th>
            </tr>
        </thead>
        <tbody>
    ';

    while ($row = mysqli_fetch_array($result, MYSQLI_BOTH))
    {
        echo '
        <tr>
            <td>' . $row[0] . '</td>
            <td>' . $row[1] . '</td>
        </tr>
        ';
    }

    echo '
        </tbody>
        </table>
    ';
}

function getCallHistory()
{
    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    $site = BASE_URL;
    if (!$link)
    {
        die('Could not connect: ' . mysql_error());
    }

    $query = "SELECT * FROM call_history";

    $result = mysqli_query($link, $query);

    $num_rows = $result->num_rows;

    if ($num_rows == 0)
    {
        echo "<div class=\"alert alert-info\"><span>There are currently no archived calls</span></div>";
    }
    else
    {
        echo '
        <table id="call_history" class="table table-striped table-bordered">
        <thead>
            <tr>
            <th>Call ID</th>
            <th>Call Type</th>
            <th>Primary Unit</th>
            <th>Street 1</th>
            <th>Street 2</th>
            <th>Street 3</th>
            <th>Narrative</th>
            <th>Actions</th>
            </tr>
        </thead>
        <tbody>
    ';

        while ($row = mysqli_fetch_array($result, MYSQLI_BOTH))
        {
            echo '
        <tr>
            <td>' . $row[0] . '</td>
            <td>' . $row[1] . '</td>
            <td>' . $row[2] . '</td>
            <td>' . $row[3] . '</td>
            <td>' . $row[4] . '</td>
            <td>' . $row[5] . '</td>
            <td>' . $row[6] . '</td>
            <td>
                <form action="'.$site.'/actions/adminActions.php" method="post">
                <input name="delete_callhistory" type="submit" class="btn btn-xs btn-link" style="color: red;" value="Delete"/>
                <input name="call_id" type="hidden" value=' . $row[0] . ' />
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

function delete_callhistory()
{
    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    $site = BASE_URL;
    if (!$link)
    {
        die('Could not connect: ' . mysql_error());
    }

    $callid = $_POST['call_id'];
    echo $callid;

    $query = "DELETE FROM call_history WHERE call_id = ?";

    try
    {
        $stmt = mysqli_prepare($link, $query);
        mysqli_stmt_bind_param($stmt, "i", $callid);
        $result = mysqli_stmt_execute($stmt);

        if ($result == false)
        {
            die(mysqli_error($link));
        }
    }
    catch(Exception $e)
    {
        die("Failed to run query: " . $e->getMessage());
    }

    session_start();
    $_SESSION['historyMessage'] = '<div class="alert alert-success"><span>Successfully removed archived call</span></div>';
    header("Location: ../oc-admin/callhistory.php#history_panel");
}
?>
