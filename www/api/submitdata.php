<?php

//error_reporting(E_ALL);
//ini_set('display_errors', 1);

require (__DIR__ . '/../../services/DbService.php');

$service = new DbService();
$isPost = $_SERVER['REQUEST_METHOD'] === 'POST';

$jsonRes = json_encode('{}');

//Check
//$conn = $service->Connect();
//if(!$conn->connect_error) {
//    $jsonRes = json_encode("{success:true}");
//    $service->Disconnect();
//}else{
//    $jsonRes = json_encode('{"success":false, "message":\'Cannot connect because '.$err.'\'}');
//}

if($isPost)  {
    $xml = $_POST["xml"];
    $output = $_POST["output"];

    $conn = $service->Connect();
    if(!$conn->connect_error) {

        $agent = $_SERVER['HTTP_USER_AGENT'];
        if( $service->Insert($agent, $xml, $output) === TRUE){
            $jsonRes = json_encode('{"success":true}');
        }   else{
            $err = $service->GetLastError();
            $jsonRes = json_encode('{"success":false, "message":\'Error on insert because $err\', "params": { "useragent": \''.$agent.'\', "xml":\''.$xml.'\', "output":\''.$output.'\' } ]}');
        }

        $service->Disconnect();

    } else{
        $err = $conn->GetLastError();
        $jsonRes = json_encode('{"success":false, "message":\'Cannot connect because '.$err.'\'}');
    }
} else{
    $jsonRes = json_encode('{"success":false, "error":\'No post mode\'}');
}

header('Content-Type: application/json');
echo $jsonRes;

?>