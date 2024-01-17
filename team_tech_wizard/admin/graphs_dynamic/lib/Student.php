<?php


class Student
{

    private $dbConn;

    public function __construct()
    {
        require_once __DIR__ . '/DataSource.php';
        $this->dbConn = new DataSource();
    }

    function getStudentMark()
    {
        $query = "SELECT user_id, verification_status FROM users ORDER BY user_id";
        $result = $this->dbConn->select($query);
        return $result;
    
    }
    
    function getcomplaints()
    {
        $query = "SELECT complaint_id,permission FROM application_request ORDER BY complaint_id";
        $result1 = $this->dbConn->select($query);
        return $result1;
    
    }
    
    function getfeedback()
    {
        $query = "SELECT complaint_id,feedback_permission FROM application_request ORDER BY complaint_id";
        $result2 = $this->dbConn->select($query);
        return $result2;
    
    }
}
