<?php

class updateApiCalls
{
    private $conn;
    private $table_name = DB_PREFIX . "config";

    // object properties
    public $count;

    // constructor for $db as database connection
    public function __construct($db)
    {
        $this->conn = $db;
    }

    function getAPICount()
    {
        $stmt = $this->conn->prepare("SELECT * FROM " . $this->table_name . " WHERE `key` = ?");
        if (!$stmt->execute(array("api_calls"))) {
            return "0x15d1531";
        }

        if ($stmt->rowCount() <= 0) {
            return "0x15d1531";
        } else {
            $result = $stmt->fetch();
            return $result;
        }
    }

    function addAPICount($count)
    {
        $count = $count["value"];
        $count++;
        $stmt = $this->conn->prepare("UPDATE ".$this->table_name." SET `value` = ? WHERE `key` = ?;");
        if (!$stmt->execute(array($count, "api_calls"))) {
            return "0x15d1531";
        }

        if ($stmt->rowCount() <= 0) {
            return "0x15d1531";
        } else {
            return $stmt;
        }
    }
}
