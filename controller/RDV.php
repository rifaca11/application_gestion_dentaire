<?php

class RDV
{
    public $reference;
    public $id;

    public function index(){
       /*  return  */
    }

    public function checkPatient()
    {


        // instantiate Database
        $database = new Database();
        $db = $database->connect();

        // instantiate patient object
        $patient = new Patient($db);

        // get raw posted data
        $data = json_decode(file_get_contents("php://input"));
    }

    public function createARDV()
    {



        // instantiate Database
        $database = new Database();
        $db = $database->connect();

        // instantiate RDV object
        $RDV = new RDVS($db);

        // get raw posted data
        $data = json_decode(file_get_contents("php://input"));

        $RDV->patientId_fk = $data->patientId_fk;
        $RDV->creneau_id_fk = $data->creneau_id_fk;
        $RDV->patient_subject = $data->patient_subject;
        $RDV->c_date = $data->c_date;

        if ($RDV->createARDV()) {

            echo json_encode(
                array('message' => 'RDV iserted',
                    'status' => true)
            );
        } else {
            echo json_encode(
                array('message' => 'RDV is not inserted',
                    'status' => false)
            );
        }
    }

    public function deleteARDV($id)
    {


        
        // instantiate Database
        $database = new Database();
        $db = $database->connect();

        // instantiate patient object
        $RDV = new RDVS($db);


        $RDV->rdv_id = $id;

        if ($RDV->deleteARDV()) {

            echo json_encode(
                array('message' => 'RDV deleted',
                        'status' => true   )
            );
        } else {
            echo json_encode(
                array('message' => 'RDV is not deleted',
                        'status' => false)
            );
        }
    }

    public function updateARDV($id)
    {



        // instantiate Database
        $database = new Database();
        $db = $database->connect();

        // instantiate RDV object
        $RDV = new RDVS($db);

        // get raw posted data
        $data = json_decode(file_get_contents("php://input"));

        // get The RDV ID
        $RDV->rdv_id = $id;

        // get the other data
        $RDV->creneau_id_fk = $data->creneau_id_fk;
        $RDV->patient_subject = $data->patient_subject;
        $RDV->c_date = $data->c_date;

        if ($RDV->updateARDV()) {

            echo json_encode(
                array('message' => 'RDV Updated')
            );
        } else {
            echo json_encode(
                array('message' => 'RDV is not Updated')
            );
        }
    }

    public function showMyRDV($id)
    {


        // instantiate Database
        $database = new Database();
        $db = $database->connect();

        // instantiate patient object
        $patient = new Patient($db);

        $patient->patientId = $id;

        $result = $patient->read_one();

        $patientInfo = array();
        $myInfo = array();
        
        $patient = array();
        $patient['personal_infos'] = array();
        $patient['rdv'] = array();
        
        if ($result) {
            $row = $result->fetch(PDO::FETCH_ASSOC);
            extract($row);

            $patient['personal_infos'] = array(
                'patientId' => $patientId,
                'patientFirstName' => $patientFirstName,
                'patientLastName' => $patientLastName,
                'patientCIN' => $patientCIN,
                'patientEmail' => $patientEmail,
                'Reference' => $Reference
            );
        }

        $RDV = new RDVS($db);
        //get the patient_id_fk
        $RDV->patientId_fk = $id;

        $rdv_result = $RDV->getRDV();

        $num = $rdv_result->rowCount();

        if ($num > 0) {
            // Appointement array
            $myRDV = array();
            // $posts_arr['data'] = array();
            $i=0;

            while ($row = $rdv_result->fetch(PDO::FETCH_ASSOC)) {
                extract($row);

                $patient['rdv'][$i] = array(
                    'rdv_id' => $rdv_id,
                    'patientId_fk' => $patientId_fk,
                    'creneau_id_fk' => $creneau_id_fk,
                    'patient_subject' => html_entity_decode($patient_subject),
                    'c_date' => $c_date,
                    'start_at' => $start_at,
                    'end_at' => $end_at
                );
                $i++;
            }

            $patient['status'] = true;
            // Turn to JSON & output
            echo json_encode($patient);
        } else {
            // No RDV
            $message = array("message" => "Oooops !! you don't have any RDVs",
                        "status" => false);
            array_push($patientInfo, $message);
            echo json_encode($patientInfo);
        }
    }

    public function checkAvailableTimes()
    {


        // instantiate Database
        $database = new Database();
        $db = $database->connect();

        // instantiate RDV object
        $RDV = new RDVS($db);

        // get raw posted data
        $data = json_decode(file_get_contents("php://input"));

        // get the inserted date
        $RDV->c_date = $data->c_date;

        // sending inserted date as paramater
        $result = $RDV->checkAvailableTimes();

        $num = $result->rowCount();
        
        $All_available_rdv = array();
        $All_available_rdv['data'] = array();
        
        if ($num > 0) {

            while ($rows = $result->fetch(PDO::FETCH_ASSOC)) {
                $available_rdv = array(
                    'creneau_id' => $rows["creneau_id"],
                    'start_at' => $rows["start_at"],
                    'end_at' => $rows["end_at"]
                );            
                // Push to "data"
                array_push($All_available_rdv['data'], $available_rdv);
        }
        $All_available_rdv['status'] = true;
        echo json_encode($All_available_rdv);
        
        }else{
            
            $msg = array("message" => "Oooops !!! you don't have any RDVs",
                        "status" => false);
            echo json_encode($msg);
        }
    }
}
