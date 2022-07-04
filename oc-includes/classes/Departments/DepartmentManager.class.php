<?php

namespace Departments;

class DepartmentManager extends \Dbh {

    public function deleteGroupItem($userId, $dept_id){
        $key = generateRandomString(64);
        $stmt = $this->connect()->prepare("DELETE FROM ".DB_PREFIX."userDepartments WHERE userId = ? AND departmentId = ?");
        if (!$stmt->execute(array($userId, $dept_id))) {
            $_SESSION['error'] = $stmt->errorInfo();
            header('Location: ' . BASE_URL . '/plugins/error/index.php');
            die();
        }
        if($stmt->errorInfo()){
            return "Error Deleting Record: " . $stmt->errorInfo();
        }
        if ($stmt->rowCount() <= 0) {
            return false;
        } else {
            return true;
        }
    }
}