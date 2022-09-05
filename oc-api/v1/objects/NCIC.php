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
        $stmt = $this->conn->prepare("SELECT * FROM " . $this->table_name);
        if (!$stmt->execute()) {
            return false;
        }

        if ($stmt->rowCount() <= 0) {
            return false;
        } else {
            return $stmt;
        }
    }

    function readbyId($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM " . $this->table_name . " WHERE id = ?");
        if (!$stmt->execute(array($id))) {
            return false;
        }

        if ($stmt->rowCount() <= 0) {
            return false;
        } else {
            return $stmt;
        }
    }

    function readbyName($name)
    {
        $stmt = $this->conn->prepare("SELECT * FROM " . $this->table_name . " WHERE name LIKE ?;");
        if (!$stmt->execute(array("%$name%"))) {
            return false;
        }

        if ($stmt->rowCount() <= 0) {
            return false;
        } else {
            return $stmt;
        }
    }


    function delete($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM " . $this->table_name . " WHERE id = ?");
        if (!$stmt->execute(array($id))) {
            return false;
        }

        if ($stmt->rowCount() <= 0) {
            return false;
        } else {
            $results = $stmt->fetchAll();
            return $results;
        }
    }

    function post($submittedByName, $submittedById, $name, $dob, $address, $gender, $race, $dlStatus, $dlType, $dlClass, $dlIssuer, $hairColor, $build, $weaponPermitStatus, $weaponPermitType, $weaponPermitIssuedBy, $bloodType, $organDonor, $deceased)
    {
        $stmt = $this->conn->prepare("INSERT " . $this->table_name . " (`submittedByName`, `submittedById`, `name`, `dob`, `address`, `gender`, `race`, `dlStatus`, `dlType`, `dlClass`, `dlIssuer`, `hairColor`, `build`, `weaponPermitStatus`, `weaponPermitType`, `weaponPermitIssuedBy`, `bloodType`, `organDonor`, `deceased`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);");
        if (!$stmt->execute(array($submittedByName, $submittedById, $name, $dob, $address, $gender, $race, $dlStatus, $dlType, $dlClass, $dlIssuer, $hairColor, $build, $weaponPermitStatus, $weaponPermitType, $weaponPermitIssuedBy, $bloodType, $organDonor, $deceased))) {
            return false;
        }

        if ($stmt->rowCount() <= 0) {
            return false;
        } else {
            $results = $stmt->fetchAll();
            return $results;
        }
    }
}


class ncicArrests
{
    private $conn;
    private $table_name = DB_PREFIX . "ncicarrests";

    public $id;
    public $nameId;
    public $arrestReason;
    public $arrestFine;
    public $issuedDate;
    public $issuedBy;

    // constructor for $db as database connection
    public function __construct($db)
    {
        $this->conn = $db;
    }

    function read()
    {
        $stmt = $this->conn->prepare("SELECT * FROM " . $this->table_name . " ORDER BY id DESC");
        if (!$stmt->execute()) {
            return false;
        }

        if ($stmt->rowCount() <= 0) {
            return false;
        } else {
            return $stmt;
        }
    }

    function readbyId($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM " . $this->table_name . " WHERE id = ?");
        if (!$stmt->execute(array($id))) {
            return false;
        }

        if ($stmt->rowCount() <= 0) {
            return false;
        } else {
            return $stmt;
        }
    }

    function readByName($name)
    {
        $stmt = $this->conn->prepare("SELECT * FROM " . $this->table_name . " LEFT JOIN " . DB_PREFIX . "ncicnames on " . $this->table_name . ".nameId = " . DB_PREFIX . "ncicnames.id WHERE " . DB_PREFIX . "ncicnames.name LIKE ?");
        if (!$stmt->execute(array("%$name%"))) {
            return false;
        }

        if ($stmt->rowCount() <= 0) {
            return false;
        } else {
            return $stmt;
        }
    }


    function post($nameId, $arrestReason, $arrestFine, $issuedDate, $issuedBy)
    {
        $stmt = $this->conn->prepare("INSERT INTO " . $this->table_name . " (`nameId`, `arrestReason`, `arrestFine`, `issuedDate`, `issuedBy`) VALUES (?, ?, ?, ?, ?);");
        if (!$stmt->execute(array($nameId, $arrestReason, $arrestFine, $issuedDate, $issuedBy))) {
            return false;
        }

        if ($stmt->rowCount() <= 0) {
            return false;
        } else {
            $results = $stmt->fetchAll();
            return $results;
        }
    }

    function update($id, $nameId, $arrestReason, $arrestFine, $issuedDate, $issuedBy)
    {
        $stmt = $this->conn->prepare("UPDATE " . $this->table_name . " SET `nameId` = ?, `arrestReason` = ?, `arrestFine` = ?, `issuedDate` = ?, `issuedBy` = ? WHERE id = ?;");
        if (!$stmt->execute(array($nameId, $arrestReason, $arrestFine, $issuedDate, $issuedBy, $id))) {
            return false;
        }

        if ($stmt->rowCount() <= 0) {
            return false;
        } else {
            $results = $stmt->fetchAll();
            return $results;
        }
    }
    function delete($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM " . $this->table_name . " WHERE id = ?");
        if (!$stmt->execute(array($id))) {
            return false;
        }

        if ($stmt->rowCount() <= 0) {
            return false;
        } else {
            $results = $stmt->fetchAll();
            return $results;
        }
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
        $stmt = $this->conn->prepare("SELECT * FROM " . $this->table_name . " LEFT JOIN " . DB_PREFIX . "ncicnames on " . $this->table_name . ".nameId = " . DB_PREFIX . "ncicnames.id");
        if (!$stmt->execute()) {
            return false;
        }

        if ($stmt->rowCount() <= 0) {
            return false;
        } else {
            return $stmt;
        }
    }

    function readbyId($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM " . $this->table_name . " LEFT JOIN " . DB_PREFIX . "ncicnames on " . $this->table_name . ".nameId = " . DB_PREFIX . "ncicnames.id WHERE " . $this->table_name . ".id = ?");
        if (!$stmt->execute(array($id))) {
            return false;
        }

        if ($stmt->rowCount() <= 0) {
            return false;
        } else {
            return $stmt;
        }
    }

    function readbyName($name)
    {
        $stmt = $this->conn->prepare("SELECT * FROM " . $this->table_name . " LEFT JOIN " . DB_PREFIX . "ncicnames on " . $this->table_name . ".nameId = " . DB_PREFIX . "ncicnames.id WHERE " . DB_PREFIX . "ncicnames.name LIKE ?;");
        if (!$stmt->execute(array("%$name%"))) {
            return false;
        }

        if ($stmt->rowCount() <= 0) {
            return false;
        } else {
            return $stmt;
        }
    }


    function delete($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM " . $this->table_name . " WHERE id = ?");
        if (!$stmt->execute(array($id))) {
            return false;
        }

        if ($stmt->rowCount() <= 0) {
            return false;
        } else {
            $results = $stmt->fetchAll();
            return $results;
        }
    }

    function post($status, $nameId, $citationName, $citationFine, $issuedDate, $issuedBy)
    {
        $stmt = $this->conn->prepare("INSERT INTO " . $this->table_name . " (`status`, `nameId`, `citationName`, `citationFine`, `issuedDate`, `issuedBy`) VALUES (?, ?, ?, ?, ?, ?);");
        if (!$stmt->execute(array($status, $nameId, $citationName, $citationFine, $issuedDate, $issuedBy))) {
            return false;
        }

        if ($stmt->rowCount() <= 0) {
            return false;
        } else {
            $results = $stmt->fetchAll();
            return $results;
        }
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
        $stmt = $this->conn->prepare("SELECT * FROM " . $this->table_name . " LEFT JOIN " . DB_PREFIX . "ncicnames on " . $this->table_name . ".nameId = " . DB_PREFIX . "ncicnames.id");
        if (!$stmt->execute()) {
            return false;
        }

        if ($stmt->rowCount() <= 0) {
            return false;
        } else {
            return $stmt;
        }
    }

    function readbyId($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM " . $this->table_name . " LEFT JOIN " . DB_PREFIX . "ncicnames on " . $this->table_name . ".nameId = " . DB_PREFIX . "ncicnames.id WHERE " . $this->table_name . ".id = ?");
        if (!$stmt->execute(array($id))) {
            return false;
        }

        if ($stmt->rowCount() <= 0) {
            return false;
        } else {
            return $stmt;
        }
    }

    function readbyName($name)
    {
        $stmt = $this->conn->prepare("SELECT * FROM " . $this->table_name . " LEFT JOIN " . DB_PREFIX . "ncicnames on " . $this->table_name . ".nameId = " . DB_PREFIX . "ncicnames.id WHERE " . DB_PREFIX . "ncicnames.name LIKE ?;");
        if (!$stmt->execute(array("%$name%"))) {
            return false;
        }

        if ($stmt->rowCount() <= 0) {
            return false;
        } else {
            return $stmt;
        }
    }


    function delete($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM " . $this->table_name . " WHERE id = ?");
        if (!$stmt->execute(array($id))) {
            return false;
        }

        if ($stmt->rowCount() <= 0) {
            return false;
        } else {
            $results = $stmt->fetchAll();
            return $results;
        }
    }

    function post($expirationDate, $warrantName, $issuingAgency, $nameId, $issuedDate, $status)
    {
        $stmt = $this->conn->prepare("INSERT INTO " . $this->table_name . " (`expirationDate`, `warrantName`, `issuingAgency`, `nameId`, `issuedDate`, `status`) VALUES (?, ?, ?, ?, ?, ?);");
        if (!$stmt->execute(array($expirationDate, $warrantName, $issuingAgency, $nameId, $issuedDate, $status))) {
            return false;
        }

        if ($stmt->rowCount() <= 0) {
            return false;
        } else {
            $results = $stmt->fetchAll();
            return $results;
        }
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
        $stmt = $this->conn->prepare("SELECT * FROM " . $this->table_name . " LEFT JOIN " . DB_PREFIX . "ncicnames on " . $this->table_name . ".nameId = " . DB_PREFIX . "ncicnames.id");
        if (!$stmt->execute()) {
            return false;
        }

        if ($stmt->rowCount() <= 0) {
            return false;
        } else {
            return $stmt;
        }
    }

    function readbyId($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM " . $this->table_name . " LEFT JOIN " . DB_PREFIX . "ncicnames on " . $this->table_name . ".nameId = " . DB_PREFIX . "ncicnames.id WHERE " . $this->table_name . ".id = ?");
        if (!$stmt->execute(array($id))) {
            return false;
        }

        if ($stmt->rowCount() <= 0) {
            return false;
        } else {
            return $stmt;
        }
    }

    function readbyName($name)
    {
        $stmt = $this->conn->prepare("SELECT * FROM " . $this->table_name . " LEFT JOIN " . DB_PREFIX . "ncicnames on " . $this->table_name . ".nameId = " . DB_PREFIX . "ncicnames.id WHERE " . DB_PREFIX . "ncicnames.name LIKE ?;");
        if (!$stmt->execute(array("%$name%"))) {
            return false;
        }

        if ($stmt->rowCount() <= 0) {
            return false;
        } else {
            return $stmt;
        }
    }


    function delete($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM " . $this->table_name . " WHERE id = ?");
        if (!$stmt->execute(array($id))) {
            return false;
        }

        if ($stmt->rowCount() <= 0) {
            return false;
        } else {
            $results = $stmt->fetchAll();
            return $results;
        }
    }

    function post($status, $nameId, $warningName, $issuedDate, $issuedBy)
    {
        $stmt = $this->conn->prepare("INSERT INTO " . $this->table_name . " (`status`, `nameId`, `warningName`, `issuedDate`, `issuedBy`) VALUES (?, ?, ?, ?, ?);");
        if (!$stmt->execute(array($status, $nameId, $warningName, $issuedDate, $issuedBy))) {
            return false;
        }

        if ($stmt->rowCount() <= 0) {
            return false;
        } else {
            $results = $stmt->fetchAll();
            return $results;
        }
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
        $stmt = $this->conn->prepare("SELECT * FROM " . $this->table_name . " LEFT JOIN " . DB_PREFIX . "ncicnames on " . $this->table_name . ".nameId = " . DB_PREFIX . "ncicnames.id");
        if (!$stmt->execute()) {
            return false;
        }

        if ($stmt->rowCount() <= 0) {
            return false;
        } else {
            return $stmt;
        }
    }

    function readbyId($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM " . $this->table_name . " LEFT JOIN " . DB_PREFIX . "ncicnames on " . $this->table_name . ".nameId = " . DB_PREFIX . "ncicnames.id WHERE " . $this->table_name . ".id = ?");
        if (!$stmt->execute(array($id))) {
            return false;
        }

        if ($stmt->rowCount() <= 0) {
            return false;
        } else {
            return $stmt;
        }
    }

    function readbyName($name)
    {
        $stmt = $this->conn->prepare("SELECT * FROM " . $this->table_name . " LEFT JOIN " . DB_PREFIX . "ncicnames on " . $this->table_name . ".nameId = " . DB_PREFIX . "ncicnames.id WHERE " . DB_PREFIX . "ncicnames.name LIKE ?;");
        if (!$stmt->execute(array("%$name%"))) {
            return false;
        }

        if ($stmt->rowCount() <= 0) {
            return false;
        } else {
            return $stmt;
        }
    }


    function delete($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM " . $this->table_name . " WHERE id = ?");
        if (!$stmt->execute(array($id))) {
            return false;
        }

        if ($stmt->rowCount() <= 0) {
            return false;
        } else {
            $results = $stmt->fetchAll();
            return $results;
        }
    }

    function post($nameId, $weaponType, $weaponName, $notes)
    {
        $stmt = $this->conn->prepare("INSERT INTO " . $this->table_name . " (`nameId`, `weaponType`, `weaponName`, `notes`) VALUES (?, ?, ?, ?);");
        if (!$stmt->execute(array($nameId, $weaponType, $weaponName, $notes))) {
            return false;
        }

        if ($stmt->rowCount() <= 0) {
            return false;
        } else {
            $results = $stmt->fetchAll();
            return $results;
        }
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

    function readByPlate($query)
    {
        $plate = $query;
        $stmt = $this->conn->prepare("SELECT * FROM " . $this->table_name . " LEFT JOIN " . DB_PREFIX . "ncicnames on " . $this->table_name . ".nameId = " . DB_PREFIX . "ncicnames.id WHERE vehPlate = ?");
        if (!$stmt->execute(array($plate))) {
            return false;
        }

        if ($stmt->rowCount() <= 0) {
            return false;
        } else {
            return $stmt;
        }
    }

    function readById($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM " . $this->table_name . " LEFT JOIN " . DB_PREFIX . "ncicnames on " . $this->table_name . ".nameId = " . DB_PREFIX . "ncicnames.id WHERE " . $this->table_name . ".id = ?");
        if (!$stmt->execute(array($id))) {
            return false;
        }

        if ($stmt->rowCount() <= 0) {
            return false;
        } else {
            return $stmt;
        }
    }
    function readByName($name)
    {
        $stmt = $this->conn->prepare("SELECT * FROM " . $this->table_name . " LEFT JOIN " . DB_PREFIX . "ncicnames on " . $this->table_name . ".nameId = " . DB_PREFIX . "ncicnames.id WHERE " . DB_PREFIX . "ncicnames.name LIKE ?");
        if (!$stmt->execute(array("%$name%"))) {
            return false;
        }

        if ($stmt->rowCount() <= 0) {
            return false;
        } else {
            return $stmt;
        }
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

    function delete($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM " . $this->table_name . " WHERE id = ?");
        if (!$stmt->execute(array($id))) {
            return false;
        }

        if ($stmt->rowCount() <= 0) {
            return false;
        } else {
            $results = $stmt->fetchAll();
            return $results;
        }
    }

    function post($nameId, $vehPlate, $vehMake, $vehModel, $vehPrimaryColor, $vehSecondaryColor, $vehInsurance, $vehInsuranceType, $flags, $vehRegState, $notes)
    {
        $stmt = $this->conn->prepare("INSERT INTO " . $this->table_name . " (`nameId`, `vehPlate`, `vehMake`, `vehModel`, `vehPrimaryColor`, `vehSecondaryColor`, `vehInsurance`, `vehInsuranceType`, `flags`, `vehRegState`, `notes`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);");
        if (!$stmt->execute(array($nameId, $vehPlate, $vehMake, $vehModel, $vehPrimaryColor, $vehSecondaryColor, $vehInsurance, $vehInsuranceType, $flags, $vehRegState, $notes))) {
            return false;
        }

        if ($stmt->rowCount() <= 0) {
            return false;
        } else {
            $results = $stmt->fetchAll();
            return $results;
        }
    }
}
