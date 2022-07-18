<?php
require_once("../oc-config.php");
require_once(ABSPATH . OCINC . "/apiAuth.inc.php");


try {
	$pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASSWORD);
	return $pdo;
} catch (PDOException $ex) {
	throw_new_error("DB Connection Error", "0xe133fd5eb502 Error Occured: " . $ex->getMessage());
	die();
}


$searchTerm = $_GET['term'];

$stmt = $this->connect()->prepare("SELECT * FROM " . DB_PREFIX . "ncicnames WHERE name LIKE ? ORDER BY name ASC");
if (!$stmt->execute(array("%$searchTerm%"))) {
	$_SESSION['error'] = $stmt->errorInfo();
	header('Location: ' . BASE_URL . '/plugins/error/index.php');
	die();
}

if ($stmt->rowCount() <= 0) {
	return false;
} else {
	$results = $stmt->fetchAll();
	
	return json_encode($results);
}
