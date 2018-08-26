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

require_once(__DIR__ . "/../oc-config.php");

//Handle requests
if (isset($_POST['update_profile_btn']))
{
    updateProfile();
}
if (isset($_GET['getMyRank']))
{
	getMyRank();
}
if (isset($_POST['changePassword']))
{
  changePassword();
}



function updateProfile()
{
    session_start();
    $id = $_SESSION['id'];
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $identifier = htmlspecialchars($_POST['identifier']);

    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

	if (!$link) {
		die('Could not connect: ' .mysql_error());
	}

    $query = "UPDATE users SET name = ?, email = ?, identifier = ? WHERE ID = ?";

	try {
		$stmt = mysqli_prepare($link, $query);
		mysqli_stmt_bind_param($stmt, "sssi", $name, $email, $identifier, $id);
		$result = mysqli_stmt_execute($stmt);

		if ($result == FALSE) {
            if (mysqli_errno($link) == 1062) {
                $_SESSION['profileUpdate'] = '<div class="alert alert-danger"><span>Update unsuccessful. Emails and Identifiers must be unique.</span></div>';
                sleep(1); //Seconds to wait
	            header("Location: ".BASE_URL."/profile.php");
            }
			die(mysqli_error($link));
		}
	}
	catch (Exception $e)
	{
		die("Failed to run query: " . $e->getMessage());
	}

    //Reset the session variables so on refresh the fields are populated correctly
	$_SESSION['email'] = $email;
	$_SESSION['name'] = $name;
	$_SESSION['identifier'] = $identifier;

	//Let the user know their information was updated
	$_SESSION['profileUpdate'] = '<div class="alert alert-success"><span>Successfully updated your user information</span></div>';

	sleep(1); //Seconds to wait
	header("Location: ".BASE_URL."/profile.php");
}

function getMyRank()
{
	$id = $_GET['unit'];
	$link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    if (!$link) {
        die('Could not connect: ' .mysql_error());
    }

    //Get all ranks
    $query = "SELECT ranks.rank_name FROM ranks_users INNER JOIN ranks ON ranks.rank_id=ranks_users.rank_id WHERE ranks_users.user_id = '$id';";

    $result=mysqli_query($link, $query);

	while($row = mysqli_fetch_array($result, MYSQLI_BOTH))
	{
		echo $row[0];
	}
}

function changePassword()
{

  error_reporting(E_ALL);
  ini_set('display_errors', 1);

  // Connect to database
  $link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

  if (!$link) {
    die('Could not connect: ' .mysql_error());
  }

  // Get users
  $query = mysqli_query($link, "SELECT * FROM `users`") or die(mysqli_error($link));

  $row = mysqli_fetch_array($query);
  $id = $row['id'];
  $password = $row['password'];
  $newpassword = htmlspecialchars($_POST['password']);
  $hashed_password = password_hash($newpassword, PASSWORD_DEFAULT);
  mysqli_query($link,"UPDATE `users` SET `password` = '$hashed_password' WHERE `id` = '$id'") or die(mysqli_error($link));

  $_SESSION['changePassword'] = '<div class="alert alert-success"><span>Password successfully updated.</span></div>';

  sleep(1); //Seconds to wait
  echo $_SESSION['changePassword'];
  header("Location: ".BASE_URL."/profile.php?changePassword=true");
}

function getRanks()
{
	$link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    if (!$link) {
        die('Could not connect: ' .mysql_error());
    }

    //Get all ranks
    $query = "SELECT * FROM ranks";

    $result=mysqli_query($link, $query);

	while($row = mysqli_fetch_array($result, MYSQLI_BOTH))
	{
		if ($row[2] == "1")
		{
			echo '<option value="'.$row[1].'">'.$row[1].'</option>';
		}
		else if ($row[2] == "0")
		{
			echo '<option value="'.$row[1].'" style="background: #969aa3; color: #ffffff;" disabled>'.$row[1].'</option>';
		}
	}
}
?>
