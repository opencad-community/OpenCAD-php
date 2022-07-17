<?php

namespace API;

class APIManager extends \Dbh
{
    public function generateAPIKey($length = 128)
    {
        
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        $time = time();
        $time = substr_replace($time, uniqid(), 3, 0);
        return uniqid($time.$randomString.session_id());
    }

    public function insertKey()
    {
        $title = $_POST["API_title"];
        $key = $_POST["API_key"];

        if (isset($_POST["API_perms"])) {
            $permissions = $_POST["API_perms"];
            $permissions = implode(", ", $permissions);
        } else {
            $permissions = "NULL";
        };

        $stmt = $this->connect()->prepare("INSERT INTO " . DB_PREFIX . "api (`title`, `value`, `permissions`) VALUES (?, ?, ?)");
        if (!$stmt->execute(array($title, $key, $permissions))) {
            $_SESSION['error'] = $stmt->errorInfo();
            header('Location: ' . BASE_URL . '/plugins/error/index.php');
            die();
        }

        if ($stmt->rowCount() <= 0) {
            return false;
        } else {
            $results = $stmt->fetchAll();
            return $results;
        }
    }

    public function getAPIs()
    {
        $stmt = $this->connect()->prepare("SELECT * FROM " . DB_PREFIX . "api");
        if (!$stmt->execute()) {
            $_SESSION['error'] = $stmt->errorInfo();
            header('Location: ' . BASE_URL . '/plugins/error/index.php');
            die();
        }

        if ($stmt->rowCount() <= 0) {
            return false;
        } else {
            $results = $stmt->fetchAll();
            return $results;
        }
    }

    public function getAPIsByKey($key)
    {
        $stmt = $this->connect()->prepare("SELECT * FROM " . DB_PREFIX . "api WHERE value = ?");
        if (!$stmt->execute(array($key))) {
            $_SESSION['error'] = $stmt->errorInfo();
            header('Location: ' . BASE_URL . '/plugins/error/index.php');
            die();
        }

        if ($stmt->rowCount() <= 0) {
            return false;
        } else {
            $results = $stmt->fetchAll();
            return $results;
        }
    }

    public function deleteAPI($id)
    {
        $stmt = $this->connect()->prepare("DELETE FROM " . DB_PREFIX . "api WHERE id=?");
        if (!$stmt->execute(array($id))) {
            $_SESSION['error'] = $stmt->errorInfo();
            header('Location: ' . BASE_URL . '/plugins/error/index.php');
            die();
        }
        if ($stmt->rowCount() <= 0) {
            return false;
        } else {
            $results = $stmt->fetchAll();
            return $results;
        }
    }

    public function getAPIKeyPermission($key)
    {
        $stmt = $this->connect()->prepare("SELECT permissions FROM " . DB_PREFIX . "api WHERE value = ?");
        if (!$stmt->execute(array($key))) {
            $_SESSION['error'] = $stmt->errorInfo();
            header('Location: ' . BASE_URL . '/plugins/error/index.php');
            die();
        }
        if ($stmt->rowCount() <= 0) {
            return false;
        } else {
            $results = $stmt->fetchAll();
            return $results;
        }
    }
}
