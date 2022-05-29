<?php

class RDVS
{

    // db var
    private $conn;
    private $table = 'RDVS';

    // RDV properties
    public $patientId_fk;
    public $creneau_id_fk;
    public $patient_subject;
    public $c_date;

    public function __construct($db)
    {
        $this->conn = $db;
    }
    public function set_date($date)
    {
        $this->c_date = $date;
    }
    
    public function createARDV()
    {

        $query = "INSERT INTO RDVS 
        (patientId_fk, creneau_id_fk, patient_subject, c_date)
        VALUES 
        (:patientId_fk, :creneau_id_fk, :patient_subject, :c_date ) ";

        // Clean data
        $this->creneau_id_fk = htmlspecialchars($this->creneau_id_fk);
        $this->patient_subject = htmlspecialchars(strip_tags($this->patient_subject));
        $this->c_date = htmlspecialchars($this->c_date);
        // prepare the query
        $stmt = $this->conn->prepare($query);
        // Bind data
        $stmt->bindParam(':patientId_fk', $this->patientId_fk);
        $stmt->bindParam(':creneau_id_fk', $this->creneau_id_fk);
        $stmt->bindParam(':patient_subject', $this->patient_subject);
        $stmt->bindParam(':c_date', $this->c_date);


        if ($stmt->execute()) {
            return true;
        }

        // print error if something goes wrong
        printf("Error %s.\n", $stmt->error);
        return false;
    }

    public function deleteARDV()
    {

        $query = "DELETE FROM RDVS WHERE rdv_id = :rdv_id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':rdv_id', $this->rdv_id);

        if ($stmt->execute()) {
            return true;
        }
        // print error if something goes wrong
        printf("Error %s.\n", $stmt->error);
        return false;
    }

    // get one user informations
    public function read()
    {
        $query = 'SELECT * FROM RDVS WHERE rdv_id = :rdv_id';
        // prepare statement
        $stmt = $this->conn->prepare($query);
        // execute statement
        $stmt->execute();
        return $stmt;
    }

    public function UpdateARDV()
    {

        $query = "UPDATE RDVS
        SET creneau_id_fk = :creneau_id_fk , patient_subject = :patient_subject, c_date = :c_date
        WHERE rdv_id = :rdv_id";

        // Clean data
        $this->rdv_id = htmlspecialchars(strip_tags($this->rdv_id));
        $this->creneau_id_fk = htmlspecialchars(strip_tags($this->creneau_id_fk));
        $this->patient_subject = htmlspecialchars(strip_tags($this->patient_subject));
        $this->c_date = htmlspecialchars(strip_tags($this->c_date));

        // prepare the query
        $stmt = $this->conn->prepare($query);
        // Bind data
        $stmt->bindParam(':rdv_id', $this->rdv_id);
        $stmt->bindParam(':creneau_id_fk', $this->creneau_id_fk);
        $stmt->bindParam(':patient_subject', $this->patient_subject);
        $stmt->bindParam(':c_date', $this->c_date);


        // execute the query
        if ($stmt->execute()) {
            return true;
        }
        // print error if something goes wrong
        printf("Error %s.\n", $stmt->error);
        return false;
    }

    public function getRDV()
    {
        $query = "SELECT * from RDVS, creneau where patientId_fk = :patientId_fk and RDVS.creneau_id_fk = creneau.creneau_id";
        // prepare the query
        $stmt = $this->conn->prepare($query);
        // bind the id
        $stmt->bindParam(':patientId_fk', $this->patientId_fk);
        // execute statement
        $stmt->execute();

        return $stmt;
    }

    public function checkAvailableTimes()
    {
        $query = "SELECT creneau_id , start_at, end_at FROM creneau WHERE NOT EXISTS (SELECT * FROM RDVS WHERE RDVS.creneau_id_fk = creneau.creneau_id AND RDVS.c_date = :c_date);";
        // prepare the query
        $stmt = $this->conn->prepare($query);
        // bind the id
        $stmt->bindParam(':c_date', $this->c_date);
        $stmt->execute();
        return $stmt;
    }

    public function getSingleAppointments($rdv_id)
    {
        $query = "SELECT * from RDVS, creneau where RDVS.creneau_id_fk = creneau.creneau_id and RDVS.rdv_id=$rdv_id";
        // prepare the query
        $stmt = $this->conn->prepare($query);
        // bind the id
        // $stmt->bindParam(':rdv_id', $this->rdv_id);
        // execute statement
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
        }
}
