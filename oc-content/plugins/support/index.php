<?php


require_once("../../../oc-config.php");
require_once("../../../oc-includes/autoload.inc.php");
require_once("fpdf.php");

if (isset($_GET["showme"]) && $_GET["showme"] == 1) {
    generatePDF();
}

if($_POST){
// $REPORTED_PROBLEM = $_POST["PROBLEMS"];
// $REPORTED_FILE = $_POST["FILE"];
$REPORTED_PROBLEM = "problem";
$REPORTED_FILE = "file";
$BASE_URL = BASE_URL;
$COMMUNITY_HOMEPAGE = COMMUNITY_HOMEPAGE;
$COMMUNITY_NAME = COMMUNITY_NAME;
$ENABLE_API_SECURITY = ENABLE_API_SECURITY;
$DB_ENGINE = getMySQLVersion();
$DB_SCHEMA = OC_DB_VERSION;
$OC_VERSION = OC_VERSION;
$HOST_DETAILS = php_uname() . "<br>";
$HTTP_HOST = $_SERVER["HTTP_HOST"];
$HOST_IP = file_get_contents("http://ipecho.net/plain");
$HTTP_USER_AGENT = $_SERVER["HTTP_USER_AGENT"];
$HTTP_ACCEPT = $_SERVER["HTTP_ACCEPT"];
$HTTP_ACCEPT_LANGUAGE = $_SERVER["HTTP_ACCEPT_LANGUAGE"];
$HTTP_ACCEPT_ENCODING = $_SERVER["HTTP_ACCEPT_ENCODING"];
$HTTP_CONNECTION = $_SERVER["HTTP_CONNECTION"];
$SERVER_NAME = $_SERVER["SERVER_NAME"];
$SERVER_ADDR = $_SERVER["SERVER_ADDR"];
$SERVER_PORT = $_SERVER["SERVER_PORT"];
$REMOTE_ADDR = $_SERVER["REMOTE_ADDR"];
$DOCUMENT_ROOT = $_SERVER["DOCUMENT_ROOT"];
$CONTEXT_DOCUMENT_ROOT = $_SERVER["CONTEXT_DOCUMENT_ROOT"];
$QUERY_STRING = $_SERVER["QUERY_STRING"];
$REQUEST_URI = $_SERVER["REQUEST_URI"];
$SCRIPT_NAME = $_SERVER["SCRIPT_NAME"];
$PHP_SELF = $_SERVER["PHP_SELF"];
$PHP_VERSION = phpversion();
$PHP_MODULES = implode(",", getModules());
$COOKIES = implode("|",$_COOKIE);




}
function generatePDF()
{
    $BASE_URL = BASE_URL;
    $COMMUNITY_HOMEPAGE = COMMUNITY_HOMEPAGE;
    $COMMUNITY_NAME = COMMUNITY_NAME;
    $ENABLE_API_SECURITY = ENABLE_API_SECURITY;
    $DB_ENGINE = getMySQLVersion();
    $DB_SCHEMA = OC_DB_VERSION;
    $OC_VERSION = OC_VERSION;
    $HOST_DETAILS = php_uname();
    $HTTP_HOST = $_SERVER["HTTP_HOST"];
    $HOST_IP = file_get_contents("http://ipecho.net/plain");
    $HTTP_USER_AGENT = $_SERVER["HTTP_USER_AGENT"];
    $HTTP_ACCEPT = $_SERVER["HTTP_ACCEPT"];
    $HTTP_ACCEPT_LANGUAGE = $_SERVER["HTTP_ACCEPT_LANGUAGE"];
    $HTTP_ACCEPT_ENCODING = $_SERVER["HTTP_ACCEPT_ENCODING"];
    $HTTP_CONNECTION = $_SERVER["HTTP_CONNECTION"];
    $SERVER_NAME = $_SERVER["SERVER_NAME"];
    $SERVER_ADDR = $_SERVER["SERVER_ADDR"];
    $SERVER_PORT = $_SERVER["SERVER_PORT"];
    $REMOTE_ADDR = $_SERVER["REMOTE_ADDR"];
    $DOCUMENT_ROOT = $_SERVER["DOCUMENT_ROOT"];
    $CONTEXT_DOCUMENT_ROOT = $_SERVER["CONTEXT_DOCUMENT_ROOT"];
    $QUERY_STRING = $_SERVER["QUERY_STRING"];
    $REQUEST_URI = $_SERVER["REQUEST_URI"];
    $SCRIPT_NAME = $_SERVER["SCRIPT_NAME"];
    $PHP_SELF = $_SERVER["PHP_SELF"];
    $PHP_VERSION = phpversion();
    $PHP_MODULES = implode(",", getModules());
    $COOKIES = $_COOKIE;


    $pdf = new FPDF();

    //Add a new page
    $pdf->AddPage();

    // Set the font for the text
    $pdf->SetFont('Arial', 'B', 18);

    // Prints a cell with given text 
    $pdf->MultiCell(190, 10, "Example Support File");
    $pdf->SetFont("Arial", '', 10);
    $pdf->MultiCell(190, 10, "BASE_URL: " . $BASE_URL);
    $pdf->MultiCell(190, 10, "COMMUNITY_HOMEPAGE: " . $COMMUNITY_HOMEPAGE);
    $pdf->MultiCell(190, 10, "COMMUNITY_NAME: " . $COMMUNITY_NAME);
    $pdf->MultiCell(190, 10, "ENABLE_API_SECURITY: " . $ENABLE_API_SECURITY);
    $pdf->MultiCell(190, 10, "DB_ENGINE: " . $DB_ENGINE);
    $pdf->MultiCell(190, 10, "DB_SCHEMA: " . $DB_SCHEMA);
    $pdf->MultiCell(190, 10, "OC_VERSION: " . $OC_VERSION);
    $pdf->MultiCell(190, 10, "HOST_DETAILS: " . $HOST_DETAILS);
    $pdf->MultiCell(190, 10, "HOST_IP: " . $HOST_IP);
    $pdf->MultiCell(190, 10, "HTTP_HOST: " . $HTTP_HOST);
    $pdf->MultiCell(190, 10, "HTTP_USER_AGENT: " . $HTTP_USER_AGENT);
    $pdf->MultiCell(190, 10, "HTTP_ACCEPT: " . $HTTP_ACCEPT);
    $pdf->MultiCell(190, 10, "HTTP_ACCEPT_LANGUAGE: " . $HTTP_ACCEPT_LANGUAGE);
    $pdf->MultiCell(190, 10, "ENABLE_API_SECURITY: " . $ENABLE_API_SECURITY);
    $pdf->MultiCell(190, 10, "HTTP_ACCEPT_ENCODING: " . $HTTP_ACCEPT_ENCODING);
    $pdf->MultiCell(190, 10, "HTTP_CONNECTION: " . $HTTP_CONNECTION);
    $pdf->MultiCell(190, 10, "SERVER_NAME: " . $SERVER_NAME);
    $pdf->MultiCell(190, 10, "SERVER_ADDR: " . $SERVER_ADDR);
    $pdf->MultiCell(190, 10, "SERVER_PORT: " . $SERVER_PORT);
    $pdf->MultiCell(190, 10, "REMOTE_ADDR: " . $REMOTE_ADDR);
    $pdf->MultiCell(190, 10, "DOCUMENT_ROOT: " . $DOCUMENT_ROOT);
    $pdf->MultiCell(190, 10, "CONTEXT_DOCUMENT_ROOT: " . $CONTEXT_DOCUMENT_ROOT);
    $pdf->MultiCell(190, 10, "QUERY_STRING: " . $QUERY_STRING);
    $pdf->MultiCell(190, 10, "REQUEST_URI: " . $REQUEST_URI);
    $pdf->MultiCell(190, 10, "SCRIPT_NAME: " . $SCRIPT_NAME);
    $pdf->MultiCell(190, 10, "PHP_SELF: " . $PHP_SELF);
    $pdf->MultiCell(190, 10, "PHP_VERSION: " . $PHP_VERSION);
    $pdf->MultiCell(190, 10, "PHP_MODULES: " . $PHP_MODULES);
    $pdf->MultiCell(190, 10, "NOTE\nThis file is just an example, please note that data sent may be different!", 1);
    // return the generated output
    $pdf->Output();
}

function getModules()
{
    $moduleArray = array();
    $modules = get_loaded_extensions();
    foreach ($modules as $module) {
        array_push($moduleArray, $module);
    }
    return $moduleArray;
}
exit();
