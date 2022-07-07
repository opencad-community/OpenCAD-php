<?php

namespace System;

class Config extends \Dbh
{
    public function generateAPI()
    {
        $key = generateRandomString(64);
        $stmt = $this->connect()->prepare("UPDATE " . DB_PREFIX . "config SET `value`='[$key]'");
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

    public function isJson($string)
    {
        json_decode($string);
        return json_last_error() === JSON_ERROR_NONE;
    }

    public function getAllTrueOptions(){
        $stmt = $this->connect()->prepare("SELECT * FROM " . DB_PREFIX . "options WHERE `autoload`='1'");
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
}
