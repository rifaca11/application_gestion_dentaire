<?php

class Patient
{
    // db stuff
    private $conn;
    private $table = 'patient';

    // users properties
    public $patientId;
    public $patientCIN;
    public $patientEmail;
    public $patientFirstName;
    public $patientLastName;
    public $Reference;

    // constructor with db
    public function __construct($db)
    {
        $this->conn = $db;
    }


    // get users informations 
    public function read()
    {
        $query = ' SELECT * FROM ' . $this->table . ';';
        // prepare statement
        $stmt = $this->conn->prepare($query);
        // execute statement
        $stmt->execute();
        // echo $stmt;
        return $stmt;
    }

    // get one patient informations
    public function read_one()
    {
        $query = 'SELECT * FROM patient  where patientId=:patientId ';
        // prepare statement
        $stmt = $this->conn->prepare($query);
        // bind patient id
        $stmt->bindParam(':patientId', $this->patientId);
        // execute statement
        $stmt->execute();
        return $stmt;
    }

    // create a patient
    public function create()
    {
        $query = " INSERT INTO patient (patientFirstName, patientLastName, patientCIN, patientEmail, Reference)
        VALUES (:patientFirstName, :patientLastName, :patientCIN, :patientEmail , :Reference) ";

        // Clean data
        $this->patientFirstName = htmlspecialchars(strip_tags($this->patientFirstName));
        $this->patientLastName = htmlspecialchars(strip_tags($this->patientLastName));
        $this->patientCIN = htmlspecialchars(strip_tags($this->patientCIN));
        $this->patientEmail = htmlspecialchars(strip_tags($this->patientEmail));

        $this->Reference = $this->Reference;

        // Bind data
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':patientFirstName', $this->patientFirstName);
        $stmt->bindParam(':patientLastName', $this->patientLastName);
        $stmt->bindParam(':patientCIN', $this->patientCIN);
        $stmt->bindParam(':patientEmail', $this->patientEmail);
        $stmt->bindParam(':Reference', $this->Reference);

        if ($stmt->execute()) {
            return true;
        }
        // print error if something goes wrong
        printf("Error %s.\n", $stmt->error);
        return false;
    }

    public function checkPatientExist()
    {
        $query = "SELECT * FROM patient WHERE Reference = :Reference";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':Reference', $this->Reference);

        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
        // $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // return $result;
    }
}
