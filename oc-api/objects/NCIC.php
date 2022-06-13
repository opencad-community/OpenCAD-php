<?php
include_once("../../../oc-config.php");

class ncicName {
    private $conn;
    private $table_name = DB_PREFIX."ncicnames";

    // object properties
    public $submittedByName;
    public $name;
    public $dob;
    public $address;
    public $gender;
    public $race;
    public $dlStatus;
    public $dlType;
    public $dlClass;
    public $dlIssuer;
    public $hairColor;
    public $build;
    public $weaponPermitStatus;
    public $weaponPermitType;
    public $weaponPermitIssuedBy;
    public $bloodType;
    public $organDonor;
    public $deceased;

    // constructor for $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    function read(){
        // Select query

        $query = "SELECT id, submittedByName, name, dob, address, gender, race, dlStatus, dlType, dlClass, dlIssuer, hairColor, build, weaponPermitStatus, weaponPermitType, weaponPermitIssuedBy, bloodType, organDonor, deceased FROM " . $this->table_name." ORDER BY id DESC";

        // prepare query statement

        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    } 
}

class ncicCitations{
    private $conn;
    private $table_name = DB_PREFIX."nciccitations";

    // object properties
    public $status;
    public $nameId;
    public $citationName;
    public $citationFine;
    public $issuedDate;
    public $issuedBy;
    public $submittedByName;
    public $name;
    public $dob;
    public $address;
    public $gender;
    public $race;
    public $dlStatus;
    public $dlType;
    public $dlClass;
    public $dlIssuer;
    public $hairColor;
    public $build;
    public $weaponPermitStatus;
    public $weaponPermitType;
    public $weaponPermitIssuedBy;
    public $bloodType;
    public $organDonor;
    public $deceased;
    // constructor for $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    function read(){
        // Select query

        $query = "SELECT * FROM ".$this->table_name." LEFT JOIN ".DB_PREFIX."ncicnames on ".$this->table_name.".nameId = ".DB_PREFIX."ncicnames.id";

        // prepare query statement

        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    } 
}