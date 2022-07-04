<?php

class ncicName
{
    private $conn;
    private $table_name = DB_PREFIX . "ncicnames";

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
    public function __construct($db)
    {
        $this->conn = $db;
    }

    function read()
    {
        // Select query

        $query = "SELECT * FROM " . $this->table_name . " ORDER BY id DESC";

        // prepare query statement

        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }
}

class ncicCitations
{
    private $conn;
    private $table_name = DB_PREFIX . "nciccitations";

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
    public function __construct($db)
    {
        $this->conn = $db;
    }

    function read()
    {
        // Select query

        $query = "SELECT * FROM " . $this->table_name . " LEFT JOIN " . DB_PREFIX . "ncicnames on " . $this->table_name . ".nameId = " . DB_PREFIX . "ncicnames.id";

        // prepare query statement

        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }
}

class ncicWarrants
{
    private $conn;
    private $table_name = DB_PREFIX . "ncicwarrants";

    // object properties
    public $expirationDate;
    public $warrantName;
    public $issuingAgency;
    public $nameId;
    public $issuedDate;
    public $status;
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
    public function __construct($db)
    {
        $this->conn = $db;
    }

    function read()
    {
        // Select query

        $query = "SELECT * FROM " . $this->table_name . " LEFT JOIN " . DB_PREFIX . "ncicnames on " . $this->table_name . ".nameId = " . DB_PREFIX . "ncicnames.id";

        // prepare query statement

        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }
}

class ncicWarning
{
    private $conn;
    private $table_name = DB_PREFIX . "ncicwarnings";

    // object properties
    public $status;
    public $nameId;
    public $warningName;
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
    public function __construct($db)
    {
        $this->conn = $db;
    }

    function read()
    {
        // Select query

        $query = "SELECT * FROM " . $this->table_name . " LEFT JOIN " . DB_PREFIX . "ncicnames on " . $this->table_name . ".nameId = " . DB_PREFIX . "ncicnames.id";

        // prepare query statement

        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }
}

class ncicWeapons
{
    private $conn;
    private $table_name = DB_PREFIX . "ncicweapons";

    // object properties
    public $status;
    public $nameId;
    public $weaponType;
    public $weaponName;
    public $userId;
    public $notes;

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
    public function __construct($db)
    {
        $this->conn = $db;
    }

    function read()
    {
        // Select query

        $query = "SELECT * FROM " . $this->table_name . " LEFT JOIN " . DB_PREFIX . "ncicnames on " . $this->table_name . ".nameId = " . DB_PREFIX . "ncicnames.id";

        // prepare query statement

        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }
}

class ncicPlates
{
    private $conn;
    private $table_name = DB_PREFIX . "ncicplates";

    // object properties
    public $nameId;
    public $vehPlate;
    public $vehMake;
    public $vehModel;
    public $vehPrimaryColor;
    public $vehSecondaryColor;
    public $vehInsurance;
    public $vehInsuranceType;
    public $flags;
    public $vehRegState;
    public $notes;

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
    public function __construct($db)
    {
        $this->conn = $db;
    }

    function search($query)
    {
        // Select query

        $query = "SELECT * FROM " . $this->table_name . " LEFT JOIN " . DB_PREFIX . "ncicnames on " . $this->table_name . ".nameId = " . DB_PREFIX . "ncicnames.id WHERE vehPlate = '$query'";

        // prepare query statement

        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }

    function read()
    {
        // Select query

        $query = "SELECT * FROM " . $this->table_name . " LEFT JOIN " . DB_PREFIX . "ncicnames on " . $this->table_name . ".nameId = " . DB_PREFIX . "ncicnames.id";

        // prepare query statement

        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }
}
