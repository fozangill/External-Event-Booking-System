<?php
// Reading Json File and Storing into MYSQL database

require_once "config.php";

$events_file_path = getcwd().'/events.json';
$file_content = file_get_contents($events_file_path);
$decodedContent = json_decode($file_content, true);

foreach ($decodedContent as $data) {

    $participation_id = filter_var($data['participation_id'], FILTER_SANITIZE_STRING);
    $employee_name = filter_var($data['employee_name'], FILTER_SANITIZE_STRING);
    $employee_mail = filter_var($data['employee_mail'], FILTER_SANITIZE_STRING);
    $event_id = filter_var($data['event_id'], FILTER_SANITIZE_STRING);
    $event_name = filter_var($data['event_name'], FILTER_SANITIZE_STRING);
    $participation_fee = filter_var($data['participation_fee'], FILTER_SANITIZE_STRING);
    $event_date = filter_var($data['event_date'], FILTER_SANITIZE_STRING);

    $sql = "SELECT * FROM participations WHERE participation_id = '" . $participation_id . "'";

    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) == 0) {

        $sql = "INSERT INTO participations (                           
                            participation_id, 
                            employee_name, 
                            employee_mail, 
                            event_id, 
                            event_name, 
                            participation_fee, 
                            event_date                      
                            )

VALUES (
        
        '$participation_id', 
        '$employee_name', 
        '$employee_mail', 
        '$event_id', 
        '$event_name', 
        '$participation_fee', 
        '$event_date'
        )";


    }
    else {
        $sql = "UPDATE participations SET                          
                          employee_name = '$employee_name', 
                          employee_mail = '$employee_mail',
                          event_id = '$event_id',
                          event_name = '$event_name',
                          participation_fee = '$participation_fee',
                          event_date = '$event_date'
                          WHERE participation_id = '$participation_id'";
    }

    mysqli_query($conn, $sql);

}


