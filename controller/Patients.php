<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
header('Access-Control-Allow-Methods:POST,GET');
header('Access-Control-Allow-Headers: content-type');
header('Content-Type: application/json');

class Patients
{

    public function index()
    {
        // header('Location:)
    }

    public function getPatientInfos($id)
    {
        // headers

        // instantiate Database
        $database = new Database();
        $db = $database->connect();

        // instantiate patient object
        $patient = new Patient($db);

        // patient informations
        $patient_array = array();

        // get patient id
        $patient->patientId = $id;

        // patient read query
        $result = $patient->read_one();

        if ($result) {
            $row = $result->fetch(PDO::FETCH_ASSOC);
            extract($row);


            $patient_array = array(
                'patientId' => $patientId,
                'patientFirstName' => $patientFirstName,
                'patientLastName' => $patientLastName,
                'patientCIN' => $patientCIN,
                'patientEmail' => $patientEmail,
                'Reference' => $Reference
            );
          
            echo json_encode(
                array($patient_array)
            );
        } else {
            echo json_encode(
                array('message' => 'patient not inserted')
            );
        }
    }


    public function read()
    {

        // headers

        // instantiate Database
        $database = new Database();
        $db = $database->connect();

        // instantiate patient object
        $patient = new Patient($db);

        // patient read query
        $result = $patient->read();

        // get row count 
        $num = $result->rowCount();

        // check if there is a patient 
        if ($num > 0) {
            // patient array
            $patients_arr = array();
            $patients_arr['data'] = array();

            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                extract($row);
                $patient_arr = array(
                    'patientId' => $patientId,
                    'patientFirstName' => $patientFirstName,
                    'patientLastName' => $patientLastName,
                    'patientEmail' => $patientEmail,
                    'patientCIN' => $patientCIN
                );
                array_push($patients_arr['data'], $patient_arr);
            }
            // Turn to JSON & output
            echo json_encode($patients_arr);
        } else {
            // No patients
            echo json_encode(
                array('message' => 'No patient found')
            );
        }
    }

    public function create()
    {

        // headers
       
        // instantiate Database
        $database = new Database();
        $db = $database->connect();

        // instantiate patient object
        $patient = new Patient($db);

        // get raw posted data
        $data = json_decode(file_get_contents("php://input"));

        if(!empty($data->patientFirstName) && !empty($data->patientLastName) && !empty($data->patientCIN) && !empty($data->patientEmail) ){

            $patient->patientFirstName = $data->patientFirstName;
            $patient->patientLastName = $data->patientLastName;
            $patient->patientCIN = $data->patientCIN;
            $patient->patientEmail = $data->patientEmail;
                
            // split string
            $arr1 = str_split($data->patientFirstName, 2);
            $arr2 = str_split($data->patientLastName, 2);
            $arr3 = str_split($data->patientCIN, 2);
    
            //Generate a random string.
            $token = openssl_random_pseudo_bytes(10);
    
            //Convert the binary data into hexadecimal representation.
            $token = bin2hex($token);
    
            // generate custom token
            $patient->Reference = $arr1[0] . $arr2[0] . $arr3[0] . $token;
    
            $P_arr = array();
            if ($patient->create()) {
    
                $P_arr = array(
                'message' => 'patient inserted',
                'state' => true,
                'reference'=>$patient->Reference);
    
                echo json_encode($P_arr);
    
            } else {
    
                $P_arr = array('message' => 'patient not inserted',
                'state' => false);
    
                echo json_encode($P_arr);
            }

        }else{
            $msg = array('message' => 'please fill all the fields');
            echo json_encode($msg);
        }
        
    }

    public function checkpatient()
    {
        // headers

        // instantiate Database
        $database = new Database();
        $db = $database->connect();

        // instantiate patient Object
        $patient = new Patient($db);

        // get raw posted data
        $data = json_decode(file_get_contents("php://input"));

        $patient->Reference = $data->Reference;
        // check if the token is valid or not 
        $patientInfo = $patient->checkPatientExist();
        
        // get the resuslt as [$patientInfo]
        
        if ($patientInfo != false) {
            
            $P = array('patientInfo' => $patientInfo,
                        'status' => true);

            echo json_encode($P);
        } else {

            $P = array('message' => "there's no id",
                        'status' => false);

            echo json_encode($P);
        }
    }
}
