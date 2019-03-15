<?php
if (isset($_GET['getDepartments']))
{
    getDepartments();
}

function getDepartments()
{
    try{
        $pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
    } catch(PDOException $ex)
    {
        $_SESSION['error'] = "Could not connect -> ".$ex->getMessage();
        $_SESSION['error_blob'] = $ex;
        header('Location: '.BASE_URL.'/plugins/error/index.php');
        die();
    }

    $result = $pdo->query("SELECT * from ".DB_PREFIX."departments");
    if (!$result)
    {
        $_SESSION['error'] = $pdo->errorInfo();
        header('Location: '.BASE_URL.'/plugins/error/index.php');
        die();
    }
    foreach ($result as $row)
    {
            echo '<option value="' . $row[0] . '">' . $row[1] . '</option>';
    }
    $pdo = null;

}



function getStreetNames()
{
    try{
        $pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
    } catch(PDOException $ex)
    {
        $_SESSION['error'] = "Could not connect -> ".$ex->getMessage();
        $_SESSION['error_blob'] = $ex;
        header('Location: '.BASE_URL.'/plugins/error/index.php');
        die();
    }

    $result = $pdo->query("SELECT name, county FROM ".DB_PREFIX."streets");

    if (!$result)
    {
        $_SESSION['error'] = $pdo->errorInfo();
        header('Location: '.BASE_URL.'/plugins/error/index.php');
        die();
    }
    $pdo = null;

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

    foreach($result as $row)
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